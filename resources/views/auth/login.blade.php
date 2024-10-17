<x-guest-layout>
    <div class="min-h-screen bg-local bg-no-repeat bg-cover bg-center" style="background-image: url('/images/iclt_gerbang.jpeg')">
        <div class="backdrop-blur-sm bg-white/30 w-screen h-screen flex flex-col ">
            <!-- Header -->
            <header class="flex justify-between items-center p-5 bg-gray-300 bg-opacity-70 shadow-lg">
                <h1 class="text-2xl font-bold text-gray-800">Aplikasi Perizinan<br/>Siswa</h1>
                <div class="space-x-4">
                    <img src="logos/app.svg" alt="app">
                </div>
            </header>

            <!-- Main Content -->
            <div class="flex-grow flex items-center justify-center p-5">
                <x-authentication-card class="bg-transparent p-8 rounded-lg shadow-none">
                    <x-slot name="logo">
                        <x-authentication-card-logo />
                    </x-slot>

                    <x-slot name="description">
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
                    </x-slot>

                    <x-slot name="footer">
                        <p class="text-sm">MAN Insan Cendekia Lampung Timur</p>
                        <div class="flex flex-row justify-center gap-3 mt-3">
                            <img src="logos/facebook.svg" alt="">
                            <img src="logos/google.svg" alt="">
                        </div>
                    </x-slot>
                </x-authentication-card>
            </div>

            {{-- Footer content --}}
            <div class="flex flex-row justify-between p-2">
                <div class="flex flex-col items-start">
                    <img src="logos/ester.svg" alt="Estersena">
                    <p>Created By: Estersena</p>
                </div>
                <div class="flex flex-col items-end">
                    <img src="logos/faq.svg" alt="FAQ">
                    <p>Frequental Ask Question</p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
