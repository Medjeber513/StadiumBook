<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="left-side">
            {{-- <img src="{{asset('images/soccer-logo.png')}}" alt=""> --}}
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
    <section>
<div>
    <form action="{{route('cancel',$datas-> id)}}" method="POST">
@csrf
        <h2>Date : {{$datas -> date}}</h2>
        <h2>Start Game : {{$datas -> startGame}}</h2>
        <h2>End Game : {{$datas -> endGame}}</h2>
        <h2>Status : {{$datas -> status}}</h2>
        <button type="submit"> Cancel</button>

    </div>
</form>

    </section>
</body>
</html>
