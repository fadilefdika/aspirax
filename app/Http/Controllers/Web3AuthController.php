<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use kornrunner\Keccak;
use Elliptic\EC;

class Web3AuthController extends Controller
{
    /**
     * Generate nonce dan kirim message yang harus ditandatangani MetaMask
     */
    public function signature(Request $request)
    {
        $code = Str::random(32); // nonce unik
        session()->put('login_nonce', $code);

        return response()->json([
            'message' => $this->getSignatureMessage($code),
            'nonce'   => $code,
        ]);
    }

    /**
     * Format pesan yang akan ditandatangani
     */
    private function getSignatureMessage($code): string
    {
        return __("You are going to sign in with us.\n\nNonce: :nonce", [
            'nonce' => $code,
        ]);
    }

    /**
     * Autentikasi user dengan verifikasi signature dari MetaMask
     */
    public function authenticate(Request $request)
{
    try {
        $request->validate([
            'address'   => 'required|string',
            'signature' => 'required|string',
        ]);

        $nonce = session()->get('login_nonce');

        if (!$nonce) {
            return response()->json(['error' => 'Nonce not found or expired'], 400);
        }

        $message = $this->getSignatureMessage($nonce);

        if (!$this->verifySignature($message, $request->signature, $request->address)) {
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        $user = User::firstOrCreate(
            ['eth_address' => strtolower($request->address)],
            [
                'name'        => $request->address,
                'email'       => strtolower($request->address) . '@gmail.com',
                'password'    => Hash::make(Str::random(32)),
                'eth_address' => strtolower($request->address),
            ]
        );

        Auth::login($user);
        session()->forget('login_nonce');

        return response()->json(['success' => true]);
    } catch (\Throwable $e) {
        return response()->json([
            'error'   => 'Server error',
            'message' => $e->getMessage(),
            'trace'   => $e->getTraceAsString()
        ], 500);
    }
}


    /**
     * Verifikasi Ethereum signature
     */
    public static function verifySignature(string $message, string $signature, string $address): bool
    {
        // Hash pesan dengan Ethereum prefix
        $msgLen = strlen($message);
        $hash = Keccak::hash(
            sprintf("\x19Ethereum Signed Message:\n%s%s", $msgLen, $message),
            256
        );

        // Pecah signature (r, s, v)
        $r = substr($signature, 2, 64);
        $s = substr($signature, 66, 64);
        $v = hexdec(substr($signature, 130, 2));

        $recId = $v - 27;
        if ($recId !== ($recId & 1)) {
            throw new \RuntimeException('Invalid signature v value');
        }

        // Recover public key
        $ec = new EC('secp256k1');
        $publicKey = $ec->recoverPubKey($hash, ['r' => $r, 's' => $s], $recId);

        // Derive address dari public key
        $derivedAddress = '0x' . substr(
            Keccak::hash(substr(hex2bin($publicKey->encode('hex')), 1), 256),
            24
        );

        return strtolower($address) === strtolower($derivedAddress);
    }
}
