<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/register-page.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
<header>

    <div class="left-side">
        <img src="images/soccer-logo.png" width="50px" height="50px" alt="">
        <h1>MatchUp</h1>
    </div>
    <div class="midle">
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="">About</a></li>
            <li><a href="">Contact</a></li>
        </ul>
    </div>
</header>


    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" :value="__('Name')">Name</label>
            <input id="name"  type="text" name="name" :value="old('name')" required autofocus autocomplete="name" ><i class="fa-solid fa-user"></i></input>
            <input-error :messages="$errors->get('name')" >
        </div>

        <!-- Email Address -->
        <div >
            <label for="email" :value="__('Email')" >Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" ><i class="fa-solid fa-envelope"></i></input>
            <x-input-error :messages="$errors->get('email')"  />
        </div>

        <!-- Password -->
        <div >
            <label for="password" :value="__('Password')">Password</label>

            <input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" ><i class="fa-solid fa-lock"></i></input>

            <x-input-error :messages="$errors->get('password')"  />
        </div>

        <!-- Confirm Password -->
        <div >
            <label for="password_confirmation" :value="__('Confirm Password')" >Confirm Password</label>

            <input id="password_confirmation"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" ></input>

            <x-input-error :messages="$errors->get('password_confirmation')"  />
        </div>

        <div >
            <a  href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button>
                {{ __('Register') }}
            </button>
        </div>
    </form>


<script src="{{asset('js/register-page.js')}}"></script>

</body>
</html>
