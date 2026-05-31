<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Player dashboard</title>
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
        <aside>
<h3>Dashboard</h3>
<a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a>
        <a href="{{route('stadiums_index')}}"> Your Stadiums</a>
        <a href="{{route('reservation.lists.index')}}"> Reservations Lists</a>
        <a href="{{route('profile.edit')}}"><i class="fa-solid fa-circle-user"></i>Profile</a>
        <a href="{{route('logout')}}"><i class="fa fa-sign-out"></i>Logout</a>
    </aside>

<section>
        <h2>List of Reservations</h2>
        <div class="containner">

            <div class="table-containner">




            <table>
                <tr>
<th>Stadium Id</th>
<th>Date</th>
<th>Start Game</th>
<th>End Game</th>
<th>Status</th>
<th>Action</th>


    </tr>
    @foreach ($datas as $data)
    <tr>
<td>{{$data -> stadium_id}}</td>
<td>{{$data -> date }}</td>
<td style="background: rgba(0, 128, 0, 0.341);border-radius:5px"><img src="{{asset('images/green whistle.png')}}" alt=""> {{$data -> startGame}}</td>
<td style="background: rgba(255, 0, 0, 0.306);border-radius:5px">  <img src="{{asset('images/red whistle.png')}}"> {{$data -> endGame}} </td>
<td>{{$data -> status}} </td>
<td style="display: flex;justify-content:space-evenly">
    <button class="green"><a href="{{route('confirm.booking',$data -> id)}}">Confirm</a></button>
    <button class="red"><a href="{{route('cancel.booking',$data -> id)}}">Cancele</a></button>
</td>


    </tr>
    @endforeach
</table>
</div>
</div>
</section>
<style>
    .red {
        background-color: red;
        color: white;
        height: 35px;

    }
    th {
        background: rgba(128, 128, 128, 0.442);
    }
    th,td {
        height: 40px !important;
        border-radius: 2px
    }
    td {
        font-weight: bolder;
    }
    .green {
        background: green;
        color: white;
        height: 35px;
    }
       section {
        grid-column:2/-1;
        grid-row: 2/-1;

    }
    td > img {
        height: 20px;
        width: 20px;
    }
             body {
            height: 100vh;
            border-radius: 10px;
            padding: 0;
            margin: 0;
            background: #081c15;
            display: grid;
            grid-template-rows: repeat(4,1fr);
            grid-template-columns: repeat(6,1fr);
        }
        .table-containner {
            background-color: white;
width: 90%;
margin-left: 5%;
            border-radius: 10px
        }
        .head-table {
            background-color: rgba(128, 128, 128, 0.37);
            border: none !important;

        }
        h2 {
            text-align: center;
            color: #00d100;
        }
        table {
            width: 100%;
            text-align: center;

            padding: 10px

        }
        header {
            padding-left: 20px;

        }

        button {

            border-radius: 5px;
            border-style: none;
            height: 30px;
            }


            .containner {
                display: flex
            }
header img {
height: 50px;
width: 50px;
}
h1 {
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    color: #5cff5c;
}

aside {
    grid-column: 1/2;
    border-radius: 10px;
    display: grid;
    grid-row: 2/-1;
    text-align: center;
    background: #00d100;
    align-items: center;
    margin-left: 20px;
}
aside a {
    text-decoration: none;
    color: black;
    font-weight: bolder;
    transition: all 1s;
    padding-top: 10px;
    padding-bottom: 10px;

}
aside a:hover {
    background: #081c15;
    color: white;
}
header {
       grid-row: 0/1 !important;
    grid-column: 1/-1;
    display: grid;
    grid-template-columns: repeat(3,1fr);
   }
   .Social-media {
    display: flex;
    justify-content: end;
    margin-right: 30px;
    grid-column: 3/-1;
   }
   .left-side {
    grid-column: 0/1;
    padding-left: 20px;
    padding-top: 20px
   }
   .Social-media ul {
    display: flex;
    justify-content: space-between ;
list-style: none;
   }
   .Social-media ul a {
    color: transparent;
    font-size: 20px;
    background: linear-gradient(to top,white 10%,#00d100 50%,#5cff5c 70%);
    background-clip: text;
   }
h3 {
    text-decoration: underline;
}
td {
    text-align: start;
    padding-left: 10px;
    border-bottom: 1px solid rgba(128, 128, 128, 0.447);
}
th,td {
    height: 25px;
}
</style>
</body>
</html>
