<body>



    <x-slot name="header">
        <h2 style="color: #8aff8a">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="profile-update">
        <div >
            <div >
                <div >
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div >
                <div >
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div >
                <div >
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
<style>
    body {
        display: grid;
        background:  #081c15;
    }
    .profile-update{
        display: grid;
        row-gap: 30px;

    }
    .profile-update > div {
        display: grid;

    }
    .profile-update > div > div> div {
        background: white(255, 0, 0, 0.068);
        display: grid;

    }

</style>
</body>
