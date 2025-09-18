import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();
import Web3 from "web3";
import axios from "axios";

window.Web3 = Web3;

document.addEventListener("DOMContentLoaded", () => {
    const metaMaskLoginButton = document.getElementById("metamask-login");

    if (metaMaskLoginButton) {
        metaMaskLoginButton.addEventListener("click", async () => {
            if (!window.ethereum) {
                const errorBox = document.getElementById("metamask-error");
                if (errorBox) {
                    errorBox.textContent =
                        "🚨 MetaMask tidak terdeteksi. Silakan install MetaMask extension di browser Anda terlebih dahulu.";
                    errorBox.classList.remove("hidden");
                }
                return;
            }

            const web3 = new Web3(window.ethereum);

            const signatureUrl =
                metaMaskLoginButton.getAttribute("data-signature-url");
            const authenticateUrl = metaMaskLoginButton.getAttribute(
                "data-authenticate-url"
            );
            const redirectUrl =
                metaMaskLoginButton.getAttribute("data-redirect-url");

            try {
                // 1️⃣ Ambil message dari server
                const response = await axios.get(signatureUrl);
                const message = response.data.message;
                const nonce = response.data.nonce;

                // 2️⃣ Ambil akun MetaMask
                const [address] = await web3.eth.requestAccounts();

                // 3️⃣ Tanda tangan message
                const signature = await web3.eth.personal.sign(
                    message,
                    address,
                    ""
                );

                // 4️⃣ Kirim ke server untuk verifikasi
                const { status } = await axios.post(authenticateUrl, {
                    address: address,
                    signature: signature,
                });

                if (status === 200) {
                    window.location = redirectUrl;
                }
            } catch (e) {
                console.error("MetaMask login failed:", e);
            }
        });
    }
});
