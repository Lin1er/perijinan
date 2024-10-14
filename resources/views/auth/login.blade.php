<x-guest-layout>
    <div class="flex flex-col min-h-screen bg-local bg-no-repeat bg-cover bg-center" style="background-image: url('/images/iclt_gerbang.jpeg')">
        <header class="flex justify-between items-center p-5 bg-gray-300">
            <h1 class="text-xl font-semibold">Aplikasi Perizinan Siswa</h1>
            <div class="space-x-4">
                <a href="{{ route('login') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">Login</a>
                <a href="{{ route('register') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">Sign Up</a>
            </div>
        </header>
        <div class="flex-grow flex items-center justify-center">
            <x-authentication-card class="bg-white bg-opacity-90 p-8 rounded-lg shadow-lg">
                <x-slot name="logo">
                    <x-authentication-card-logo />
                </x-slot>
                <h2 class="text-center text-2xl font-bold mb-6">Selamat Datang di Aplikasi</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>
                    <div class="mb-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>
                    <div class="flex items-center justify-between mb-4">
                        <label for="remember_me" class="flex items-center">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class="text-sm text-blue-600 hover:text-blue-800" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                    <x-button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full">
                        {{ __('Log in') }}
                    </x-button>
                </form>
            </x-authentication-card>
        </div>
    </div>
</x-guest-layout>
