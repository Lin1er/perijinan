<x-guest-layout>
    <div class="min-h-screen bg-local bg-no-repeat bg-cover bg-center" style="background-image: url('/images/iclt_gerbang.jpeg')">
        <div class="backdrop-blur-sm bg-white/30 w-screen h-screen flex flex-col ">
            <!-- Header -->
            <header class="flex justify-between items-center p-5 bg-gray-300 bg-opacity-70 shadow-lg">
                <h1 class="text-2xl font-bold text-gray-800">Aplikasi Perizinan<br/>Siswa</h1>
                <div class="space-x-4">
                    <img src="logos/ester.svg" class="w-20 h-20" alt="app">
                </div>
            </header>

            <!-- Main Content -->
            <div class="flex-grow flex items-center justify-center p-5">
                <x-authentication-card-sec class="bg-transparent p-8 rounded-lg shadow-none">
                    <x-slot name="logo">
                        <x-authentication-card-logo />
                    </x-slot>

                    <x-slot name="description">
                        <div class="flex flex-col gap-7">
                            <h2 class="text-center text-3xl font-bold mb-10 text-black">Selamat Datang di Aplikasi<br>Perizinan Siswa</h2>
                            <!-- Buttons -->
                            <div class="flex flex-col justify-center gap-4">
                                <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 text-center">Login</a>
                                <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300 text-center">Register</a>
                            </div>

                        </div>
                    </x-slot>

                    <x-slot name="footer">
                        <p class="text-sm">MAN Insan Cendekia Lampung Timur</p>
                        <div class="flex flex-row justify-center gap-3 mt-3">
                            <img src="logos/facebook.svg" alt="">
                            <img src="logos/google.svg" alt="">
                        </div>
                    </x-slot>
                </x-authentication-card-sec>
            </div>

            {{-- Footer content --}}
            <div class="flex flex-row justify-between p-2">
                <div class="flex flex-col items-start">
                    <img src="logos/ester.svg" alt="Estersena">
                    <p>Created By: Estersena</p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
