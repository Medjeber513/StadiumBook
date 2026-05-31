<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>edit infos</title>
</head>
<body>
<header>
    <div class="left-side">
        <h1>MatchUp</h1>
        <img src="{{asset('images/soccer-logo.png')}}" alt="">
    </div>
            <div class="Social-media">
        <ul>
            <li><a href=""><i class="fa-brands fa-facebook"></i></a></li>
            <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
            <li><a href=""><i class="fa-brands fa-github"></i></a></li>
        </ul>
    </div>
</header>
<section>
    <div class="form-box">
        <form action="{{route('stadium_update',$datas-> id)}}" method="POST">
            <h3>Change Stadium Infos</h3>
            @csrf
            <div>
                <label for="">stadium name </label>
                <input type="text" name="name" value="{{$datas-> name}}">
            </div>
            <div>
                <label for="">Stadium location</label>
                <input type="text" name="location" value="{{$datas-> location}}"><i style="color: blue" class="fa-solid fa-location-dot"></i></input>
            </div>
            <div>
                <label for="">Price</label>
                <input type="text" name="price" value="{{$datas-> price}}"><i style="color: green" class="fa-solid fa-money-bill"></i></input>
            </div>
            <div>
                <label for="">Max Player</label>
                <input type="text" name="maxPlayer" value="{{$datas-> maxPlayer}}">
            </div>
            <div>
                <label for="">Min Player</label>
                <input type="text" name="minPlayer" value="{{$datas-> minPlayer}}">
            </div>
            <div>
                <label for="">Open Time</label>
                <input type="text" name="openTime" value="{{$datas-> openTime}}"><i class="green fa-solid fa-clock"></i></input>
            </div>
            <div>
                <label for="">Close Time</label>
                <input type="text" name="closeTime" value="{{$datas-> closeTime}}"><i class="red fa-solid fa-clock"></i></input>
            </div>
    <button type="submit">Update</button>
</form>
</div>
</section>
    <aside>
<h3>Dashboard</h3>
<a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a>
        <a href="{{route('stadiums_index')}}">Your Stadiums</a>
        <a href="{{route('create_stadium')}}">Add Stadium</a>
        <a href="{{route('reservation.lists.index')}}"> Reservations</a>
        <a href="{{route('profile.edit')}}"><i class="fa-solid fa-circle-user"></i>Profile</a>
        <a href="{{route('logout')}}"><i class="fa fa-sign-out"></i>Logout</a>
    </aside>

</body>
</html>
