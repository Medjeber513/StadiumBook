<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<header>

    <div class="left-side">

        <img src="../images/Soccer-logo.png" width="50px" height="50px" alt="">
        <h1>MatchUp</h1>
    </div>
                <div class="Social-media">
        <ul>
            <li><a href=""><i class="fa-brands fa-facebook"></i></a></li>
            <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
            <li><a href=""><i class="fa-brands fa-github"></i></a></li>
        </ul>
    </div>

</header>
    <aside>
<h3>Dashboard</h3>
<a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a>
        <a href="{{route('stadiums_index')}}">Your Stadiums</a>
        <a href="{{route('create_stadium')}}">Add Stadium</a>
        <a href="{{route('reservation.lists.index')}}"> Reservations</a>
        <a href="{{route('profile.edit')}}"><i class="fa-solid fa-circle-user"></i>Profile</a>
        <a href="{{route('logout')}}"><i class="fa fa-sign-out"></i>Logout</a>
    </aside>
<section>

    <div class="form-box">

        <form action="{{route('store_stadium')}}" method="POST">
            @csrf
            <div>
                <label for="">stadium name </label>
                <input type="text" name="name" >
            </div>
            <div>
                <label for="">Stadium location</label>
                <input type="text" name="location" ><i style="color: blue" class="fa-solid fa-location-dot"></i></input>
            </div>
            <div>
                <label for="">Price</label>
                <input type="text" name="price"> <i style="color: green" class="fa-solid fa-money-bill"></i></input>
            </div>
            <div>
                <label for="">Max Player</label>
                <input type="text" name="maxPlayer" >
            </div>
            <div>
                <label for="">Min Player</label>
                <input type="text" name="minPlayer" ">
            </div>
            <div>
                <label for="">Open Time</label>
                <input type="text" name="openTime" ><i class="green fa-solid fa-clock"></i></input>
            </div>
            <div>
                <label for="">Close Time</label>
                <input type="text" name="closeTime" ><i class="red fa-solid fa-clock"></i></input>
            </div>
            <button type="submit">Create</button>
        </form>
    </div>
</section>

</body>
</html>
