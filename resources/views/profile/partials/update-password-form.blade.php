<section>
    <header>
        <h2 style="color: #00d100;margin-left:50px">
            {{ __('Update Password') }}
        </h2>

        <p style="color:white;font-size:16px">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" style="display: grid;border-radius:10px;background:white;width:400px;padding:30px;row-gap:10px">
        @csrf
        @method('put')

        <div style="width: 80%;margin-left:10%;display:grid;">
            <x-input-label style="color: #00d100;margin-bottom:10px" for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input style="height: 30px;border-radius:5px;background:rgba(128, 128, 128, 0.274);width:220px;border-style:none;color:black;" id="update_password_current_password" name="current_password" type="password"  autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div style="width: 80%;margin-left:10%;display:grid;">
            <x-input-label style="color: #00d100;margin-bottom:10px" for="update_password_password" :value="__('New Password')" />
            <x-text-input style="height: 30px;border-radius:5px;background:rgba(128, 128, 128, 0.274);width:220px;border-style:none;color:black;" id="update_password_password" name="password" type="password"  autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div style="width: 80%;margin-left:10%;display:grid;">
            <x-input-label style="color: #00d100;margin-bottom:10px" for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input style="height: 30px;border-radius:5px;background:rgba(128, 128, 128, 0.274);width:220px;border-style:none;color:black;" id="update_password_password_confirmation" name="password_confirmation" type="password"  autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button style="background: #00d100;border-style:none;height:30px;border-radius:5px;width:80px;font-weight: bolder;cursor: pointer;margin-left:70%">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
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
