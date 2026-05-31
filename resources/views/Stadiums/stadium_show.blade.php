<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stadium Infos</title>
</head>
<body>
    <header>
        <div class="left-side">
            <img src="{{asset('images/soccer-logo.png')}}" alt="">
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


        <div class="SI">
            <div> <li>Stadium Name</li>  <li>{{$datas-> name}}</li></div>
            <div ><li> <i style="color: blue" class="fa-solid fa-location-dot"></i> Stadium Location</li> <li>{{$datas-> location}}</li></div>
            <div> <li><i style="color: green" class="fa-solid fa-money-bill"></i> Game Price </li> <li>{{$datas-> price}}</li> </div>
            <div> <li>Max Player</li> <li>{{$datas-> maxPlayer}}</li></div>
            <div>Min Player  <li>{{$datas-> minPlayer}}</li></div>
            <div> <li> <i class="green fa-solid fa-clock"></i> Open Time </li><li>{{$datas-> openTime}}</li> </div>
            <div> <li> <i class="red fa-solid fa-clock"></i> Closing Time</li> <li>{{$datas-> closeTime}}</li></div>

        </div>


        <div>
            <h2>Make Reservation</h2>
            <form action="{{route('store.booking',$datas-> id)}}" method="POST">
                @csrf
                <div>
                    <label for="">Date</label>
                    <input type="date" id="date" name="date" id=""><i class="fa-solid "></i></input>
                </div>
                                <div>
                    <label for="">Start Game</label>
                    <select type="time" id="start_game" name="startGame" ><img height="20px" width="20px" src="{{asset('images/green whistle.png')}}" alt=""></select>
                </div>
                                <div>
                    <label for="">End Game</label>
                    <input type="time" id="end_game" name="endGame" readonly><img height="20px" width="20px" src="{{asset('images/red whistle.png')}}" alt=""></input>
                </div>
                <input type="hidden" id="stadium_id" value="{{ $datas->id }}">
                <button id="bookBtn" type="submit"> Reserve </button>

            </form>

    </div>

</section>
    <aside>
<h3>Dashboard</h3>
<a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a>
        <a href="{{route('stadiumsForPlayers.list')}}">Your Stadiums</a>
        <a href="">Your  Reservations</a>
        <a href="{{route('profile.edit')}}"><i class="fa-solid fa-circle-user"></i>Profile</a>
        <a href="{{route('logout')}}"><i class="fa fa-sign-out"></i>Logout</a>
    </aside>

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const stadiumId = document.getElementById('stadium_id').value;
        const dateInput = document.getElementById('date');
        const startSelect = document.getElementById('start_game');
        const endInput = document.getElementById('end_game');

        console.log(stadiumId);
    dateInput.addEventListener('change', loadTimes);

    startSelect.addEventListener('change', function () {
        let hour = parseInt(this.value.split(':')[0]);
        endInput.value = (hour + 1).toString().padStart(2, '0') + ':00';
    });

    function loadTimes() {
        let date = dateInput.value;
        if (!date) return;

        fetch(`/stadiums/${stadiumId}/available-times?date=${date}`)
            .then(res => res.json())
            .then(data => {
                startSelect.innerHTML = '';

                data.available_times.forEach(time => {
                    let option = document.createElement('option');
                    option.value = time;
                    option.textContent = time;
                    startSelect.appendChild(option);
                });


                if (startSelect.value) {
                    let hour = parseInt(startSelect.value.split(':')[0]);
                    endInput.value = (hour + 1).toString().padStart(2, '0') + ':00';
                }
            });
    }

});
</script>
</body>
</html>
