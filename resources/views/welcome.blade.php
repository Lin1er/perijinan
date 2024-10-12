<x-guest-layout>
    <div class="min-h-screen flex flex-col">
        <header class="bg-green-500 p-4">
            <nav class="container mx-auto flex justify-between items-center">
                <div>
                    <a href="/" class="text-white font-bold text-xl">Aplikasi Perizinan Pulang</a>
                </div>
                <div>
                    @auth
                        <a href="/pengajuan" class="text-white font-semibold hover:underline">
                            Pengajuan
                        </a>
                    @else
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="text-white font-semibold mr-4 hover:underline">
                                Login
                            </a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-white font-semibold hover:underline">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            </nav>
        </header>

        <main class="flex-grow container mx-auto mt-12 text-center">
            <h1 class="text-4xl font-bold text-gray-800">Selamat Datang di Aplikasi Perizinan Pulang</h1>
            <p class="mt-4 text-lg text-gray-600">Aplikasi ini mempermudah proses pengajuan izin pulang untuk anak asrama.</p>

            <div class="mt-8 flex flex-col gap-4">
                @auth
                    <a href="/pengajuan" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Ajukan Izin Pulang
                    </a>
                    <a href="/status-pengajuan" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Status Pengajuan
                    </a>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <button type="submit"
                         class="bg-red-500 hover:bg-red-700 px-4 py-2 rounded text-white"
                        >
                            Log out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Register
                    </a>
                @endauth
            </div>
        </main>

        <footer class="bg-gray-800 p-4 text-center text-white">
            &copy; 2024 Aplikasi Perizinan Pulang. All rights reserved.
        </footer>
    </div>
</x-guest-layout>
