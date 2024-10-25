<x-guest-layout>
    <div class="min-h-screen bg-local bg-no-repeat bg-cover bg-center" style="background-image: url('/images/iclt_gerbang.jpeg')">
        <div class="backdrop-blur-sm bg-white/30 w-screen h-screen flex flex-col ">
            <!-- Header -->
            <header class="flex justify-between items-center px-5 bg-gray-300 bg-opacity-70 shadow-lg">
                <h1 class="text-2xl font-bold text-gray-800">Aplikasi Perizinan<br/>Siswa</h1>
                <div class="space-x-4">
                    <img src="logos/app.svg" alt="app">
                </div>
            </header>

            <!-- Main Content -->
            <div class="flex-grow flex items-center justify-center">
                <x-authentication-card-sec class="bg-transparent px-8 rounded-lg shadow-none">
                    <x-slot name="logo">
                        {{-- <x-authentication-card-logo /> --}}
                        <h1 class="">Buat Akun</h1>
                    </x-slot>

                    <x-slot name="description">
                        <x-validation-errors class="" />

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div class="mb-4">
                                <x-label for="name" value="{{ __('Name') }}" />
                                <x-input id="name" class="block mt-1 w-full rounded-md" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            </div>

                            <!-- Email Address -->
                            <div class="mb-4">
                                <x-label for="email" value="{{ __('Email') }}" />
                                <x-input id="email" class="block mt-1 w-full rounded-md" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            </div>

                            <!-- Phone Number -->
                            <div class="mb-4">
                                <x-label for="phone" value="{{ __('Phone Number') }}" />
                                <x-input id="phone" class="block mt-1 w-full rounded-md" type="tel" name="phone" :value="old('phone')" required placeholder="08xxxxxxxxxx" pattern="[0-9]{10,13}" autocomplete="tel" />
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <x-label for="password" value="{{ __('Password') }}" />
                                <x-input id="password" class="block mt-1 w-full rounded-md" type="password" name="password" required autocomplete="new-password" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                <x-input id="password_confirmation" class="block mt-1 w-full rounded-md" type="password" name="password_confirmation" required autocomplete="new-password" />
                            </div>

                            <!-- Terms and Privacy Policy -->
                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mt-4">
                                    <x-label for="terms">
                                        <div class="flex items-center">
                                            <x-checkbox name="terms" id="terms" required />

                                            <div class="ml-2 text-sm">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </x-label>
                                </div>
                            @endif

                            <!-- Submit Button -->
                            <div class="flex items-center justify-end mt-4">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>

                                <x-button class="ml-4 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">
                                    {{ __('Register') }}
                                </x-button>
                            </div>
                        </form>
                    </x-slot>

                    <x-slot name="footer">
                        <p class="text-sm mb-3">MAN Insan Cendekia Lampung Timur</p>
                        <div class="flex flex-row justify-center gap-3">
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
                <div class="flex flex-col items-end">
                    <img src="logos/faq.svg" alt="FAQ">
                    <p>Frequental Ask Question</p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
