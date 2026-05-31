


    <section  >
        <header>
        <h2 style="color: #00d100;margin-left:50px">
            {{ __('Profile Information') }}
        </h2>

        <p style="color:white;font-size:16px">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post"  action="{{ route('profile.update') }}" style="display: grid;border-radius:10px;background:white;width:400px;padding:30px;row-gap:10px" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div style="width: 80%;margin-left:10%;display:grid;">
            <x-input-label style="color: #00d100;margin-bottom:10px" for="name" :value="__('Name')" />
            <x-text-input style="height: 30px;border-radius:5px;background:rgba(128, 128, 128, 0.274);width:220px;border-style:none;color:black;" id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

        <div style="width: 80%;margin-left:10%;display:grid;">
            <x-input-label for="email" style="color: #00d100;" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email"   style="height: 30px;border-radius:5px;background:rgba(128, 128, 128, 0.274);width:220px;border-style:none;color:black;"  :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
                @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button style="background: #00d100;border-style:none;height:30px;border-radius:5px;width:80px;font-weight: bolder;cursor: pointer;margin-left:70%">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </section>

