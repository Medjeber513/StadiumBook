<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stadiums List</title>
</head>
<body>
<header>
    <div class="left-side">
        <h1>MatchUp</h1>
        <img src="" alt="">

    </div>
    </header>
    <h2 style="color:#52b788;text-align:center">Chose A field and make reservation</h2>


    {{-- name location price maxPlayer minPlayer openTime closeTime --}}
    <section>
            @foreach ($datas as $data)
            <div class="stadium-card">
                <img src="/images/StadiumImage.jpg" alt="">
                <div>

                    <h3> Stadium Name : <span>{{$data-> name}}</span></h3>
                    <h3> Location <i style="color: blue" class="fa-solid fa-location-dot"></i><span>{{$data-> location}}</span></h3>
                    <div id="more_info">
                        <h3> Price of the pitch <span>{{$data-> price}}</span></h3>
                        <h3> max Player <span>{{$data-> maxPlayer}}</span></h3>
                        <h3> min Player <span>{{$data-> minPlayer}}</span></h3>
                        <h3> Opent at <i style="color: red" class="fa-solid fa-clock"></i> <span> {{$data-> openTime}}</span></h3>
                        <h3> Close At  <i style="color: green" class="fa-solid fa-clock"></i> <span>{{$data-> closeTime}}</span></h3>
                    </div>
                </div>
                <div class="card_footer">

                    <button onclick="infosShow()" {{route("show_stadium",$data->id)}} style="background:navy;color:white"  id="view" ><a href="{{route("show_stadium",$data->id)}} ">View More</a></button>
                    <button ><a href="">Booking</a></button>
                </div>
            </div>
            @endforeach
    </section>


</body>
</html>
