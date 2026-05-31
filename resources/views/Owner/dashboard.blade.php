<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Owner dashboard</title>
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
        <div class="Stadium-list">
            <a href="{{route('stadiums_index')}}">
                <img src="{{asset('images/stadium_9707148.png')}}" alt="">
                <h2>Stadiums</h2>
            </a>

        </div>
                <div class="Reservation">
            <a href="{{route('reservation.lists.index')}}">
                <img src="{{asset('images/calendar_8181970.png')}}" alt="">
                <h2>Reservations</h2>
            </a>

        </div>
                        <div class="Profile">
            <a href="{{route('profile.edit')}}">
                <img src="{{asset('images/profile-logo.png')}}" alt="">
                <h2>Profile</h2>
            </a>

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
    <style>
section > div {
    background: white;
    width: 250px;
    height: 150px;
    border-bottom: 8px solid #00d100;
    border-radius: 10px;
    transition: all 1s linear;
}
section > div:hover {
    background: linear-gradient(#081c15,#00d100,white);
    color: white;
    border-bottom: white solid 8px;
}
section   img {
    height: 80px;
    width: 80px;
    margin-left: 20px
}
section > div a {
text-decoration: none;
}
section > div h2 {
    text-align: center;
    color: #081c15
}

   body {
    margin: 0;
    padding: 0;
    border-radius: 10px;
    display: grid;
  grid-template-columns: repeat(6,1fr);
    background: #081c15;
    height: 80vh;
    width: 100%;
    grid-template-rows: repeat(4,1fr);
  font-family: "Cairo", sans-serif;
  font-optical-sizing: auto;
  font-weight: <weight>;
  font-style: normal;
  font-variation-settings:
    "slnt" 0;
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
    width: 200px;
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
section {
    margin-left: 100px;
    display: flex;
    gap: 80px;
    justify-content: space-evenly;

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
    </style>
</body>
</html>
