<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 grid grid-cols-12 gap-6">

        <!-- Sidebar kiri -->
        <aside class="hidden md:block md:col-span-3 space-y-4">
            <div class="bg-white shadow rounded-xl p-4">
                <h2 class="text-xl font-bold mb-4">Menu</h2>
                <nav class="space-y-2">
                    <a href="#" class="block px-3 py-2 rounded-lg hover:bg-gray-100 font-medium">🏠 Home</a>
                    <a href="#" class="block px-3 py-2 rounded-lg hover:bg-gray-100 font-medium">📊 Explore</a>
                    <a href="#" class="block px-3 py-2 rounded-lg hover:bg-gray-100 font-medium">🔔 Notifications</a>
                    <a href="#" class="block px-3 py-2 rounded-lg hover:bg-gray-100 font-medium">✉️ Messages</a>
                    <a href="#" class="block px-3 py-2 rounded-lg hover:bg-gray-100 font-medium">👤 Profile</a>
                </nav>
            </div>
        </aside>

        <!-- Feed utama -->
        <main class="col-span-12 md:col-span-6 space-y-6">
            <!-- Composer -->
            <div class="bg-white shadow rounded-xl p-4">
                <h2 class="text-lg font-semibold mb-3">Apa yang sedang kamu pikirkan?</h2>
                <form action="#" method="POST">
                    <textarea
                        class="w-full border rounded-lg p-3 resize-none focus:ring focus:ring-blue-300"
                        rows="3"
                        placeholder="Tulis sesuatu..."></textarea>
                    <div class="flex justify-end mt-3">
                        <button
                            type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg shadow">
                            🚀 Posting
                        </button>
                    </div>
                </form>
            </div>

            <!-- Feed (dummy posts) -->
            <div class="space-y-4">
                @for ($i = 1; $i <= 5; $i++)
                    <div class="bg-white shadow rounded-xl p-4">
                        <div class="flex items-center space-x-3 mb-2">
                            <div class="w-10 h-10 rounded-full bg-gray-300"></div>
                            <div>
                                <p class="font-bold">User {{ $i }}</p>
                                <p class="text-sm text-gray-500">@user{{ $i }}</p>
                            </div>
                        </div>
                        <p class="text-gray-800">
                            Ini adalah postingan contoh ke-{{ $i }}. Bisa diganti nanti dengan data dari database.
                        </p>
                    </div>
                @endfor
            </div>
        </main>

        <!-- Sidebar kanan -->
        <aside class="hidden lg:block lg:col-span-3 space-y-4">
            <div class="bg-white shadow rounded-xl p-4">
                <h2 class="text-xl font-bold mb-4">Trending</h2>
                <ul class="space-y-2">
                    <li class="text-gray-700">🔥 Laravel 11</li>
                    <li class="text-gray-700">⚡ Tailwind 4</li>
                    <li class="text-gray-700">📈 Web3 Login</li>
                </ul>
            </div>
            <div class="bg-white shadow rounded-xl p-4">
                <h2 class="text-xl font-bold mb-4">Who to follow</h2>
                <ul class="space-y-3">
                    <li class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 rounded-full bg-gray-300"></div>
                            <span>User A</span>
                        </div>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm">
                            Follow
                        </button>
                    </li>
                    <li class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 rounded-full bg-gray-300"></div>
                            <span>User B</span>
                        </div>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm">
                            Follow
                        </button>
                    </li>
                </ul>
            </div>
        </aside>
    </div>
</x-app-layout>
