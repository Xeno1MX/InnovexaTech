<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Matric Number -->
        <div>
            <x-input-label for="matric_number" :value="__('Matric Number')" />
            <x-text-input id="matric_number" name="matric_number" type="text" class="mt-1 block w-full" :value="old('matric_number', $user->matric_number)" required autocomplete="matric-number" />
            <x-input-error class="mt-2" :messages="$errors->get('matric_number')" />
        </div>

        <!-- Identity Card Number -->
        <div>
            <x-input-label for="identitynumber" :value="__('Identity Card Number')" />
            <x-text-input id="identitynumber" name="identitynumber" type="text" class="mt-1 block w-full" :value="old('identitynumber', $user->identitynumber)" required autocomplete="identitynumber" />
            <x-input-error class="mt-2" :messages="$errors->get('identitynumber')" />
        </div>

        <!-- Faculty -->
        <div>
            <x-input-label for="faculty" :value="__('Faculty')" />
            <x-text-input id="faculty" name="faculty" type="text" class="mt-1 block w-full" :value="old('faculty', $user->faculty)" required autocomplete="faculty" />
            <x-input-error class="mt-2" :messages="$errors->get('faculty')" />
        </div>

        <!-- Contact -->
        <div>
            <x-input-label for="contact" :value="__('Contact')" />
            <x-text-input id="contact" name="contact" type="text" class="mt-1 block w-full" :value="old('contact', $user->contact)" required autocomplete="contact" />
            <x-input-error class="mt-2" :messages="$errors->get('contact')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="!bg-custom-purple">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
