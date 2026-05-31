<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<header>
    <div class="left-side">

        <img src="{{asset('images/soccer-logo.png')}}" width="50px" height="50px" alt="">
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

    <h2>Stadiums List</h2>
    <div class="containner">



        <div class="table-containner">
            <table>
                <h3 style="text-align: center;
">Your Stadiums</h3>
    <button class="add" ><a href="{{route('create_stadium')}}">Add a Stadium</a></button>
    <tr class="head-table">
        <th>Stadium name</th>
        <th>Stadium location</th>
        <th>Price</th>
        <th>Max Player</th>
        <th>Min Player</th>
        <th>Open Time</th>
        <th>Close Time</th>

        <th>Action</th>
    </tr>
    @foreach ($datas as $data)

    <tr>
        <td>{{$data-> name}} </td>
        <td style="background:rgba(0, 0, 255, 0.338)"> <i style="color: blue" class="fa-solid fa-location-dot"></i> {{$data-> location}} </td>
        <td> <i style="color: green" class="fa-solid fa-money-bill"></i>{{$data-> price}} </td>
        <td>{{$data-> maxPlayer }} </td>
        <td>{{$data-> minPlayer }}</td>
        <td style="background: rgba(0, 128, 0, 0.232)"> <i class="green fa-solid fa-clock"></i> {{$data-> openTime}}</td>
        <td style="background: rgba(255, 0, 0, 0.257)">  <i class="red fa-solid fa-clock"></i>{{$data-> closeTime}}</td>


        <td>
            <a style="color: blue" href="{{route('stadium_edit',$data-> id)}}"><i class="fa-solid fa-edit"></i></a>
            <a style="color: red" href="{{route('delete_stadium',$data-> id)}}"><i class="fa-solid fa-trash "></i></a>
        </td>
    </tr>
    @endforeach
</table>
</div>
</div>
</section>

</body>
</html>
