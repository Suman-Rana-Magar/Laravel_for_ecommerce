<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="{{ asset('images/llooggoo.png') }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('storage/lagauney.png')}}" rel="icon">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="product_detail.html">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    </link>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<style>
    body {
        background: linear-gradient(to right, #c04848, #480048);
    }

    nav {
        background: linear-gradient(to bottom, #c04848, #480048);
    }

    .nav-link {
        font-size: 20px;

    }

    .dropdown-menu {
        background-color: aqua;
    }

    img:hover {
        opacity: 75%;
    }

    .imf {
        max-width: 250px;
        max-height: 250px;
    }

    .col-sm-3 {
        width: 280px;
    }

    a {
        text-decoration: none;
    }

    a:hover
    {
        text-decoration: none;
    }

    #lblCartCount {
        font-size: 15px;
        background: #ff0000;
        color: #fff;
        padding: 5px;
        vertical-align: top;
        margin-left: -10px;
        margin-top: -10px;
        border-radius: 50%;
    }

    .links {
        text-decoration: none;
        font-size: 20px;
    }

    .links a {
        padding-left: 10px;
        color: skyblue;
    }

    .logo h1
    {
        font-family:'Kalam'; 
        margin-left: 20px;
        display: inline;
        font-size: 45px;
        color: #07e5f5;
    }
    .logo .one
    {
        font-family:'Kalam'; 
        color: white; 
        display: inline;
        color: #07f51f;
    }
    .logo .two
    {
        font-family:'Kalam'; 
        color: white; 
        display: inline;
        color: #e5f507;
    }
    .logo .three
    {
        font-family:'Kalam'; 
        color: white; 
        display: inline;
        color: #ba07f5;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!--<a class="navbar-brand" href="#">Navbar</a>-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a style="text-decoration: none;" href="{{route('products.index')}}">
            <div class="logo"><h1>ल</h1><h2 class="one">गा</h2><h2 class="two">उ</h2><h2 class="three">ने</h2></div>
        </a>
        <div style="margin-left: 250px;" class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li>
                    <a style="color: white;" class="nav-link" href="{{route('products.index')}}">Home</a>
                </li>
                <li>
                    <a style="color: white;" class="nav-link" href="#">About Us</a>
                </li>
                <li>
                    <a style="color: white;" class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Our Services
                    </a>
                </li>
                <li>
                    <a style="color: white;" class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>
            <form style="margin-right: 20px;" class="form-inline my-2 my-lg-0" method="get" action="{{route('products.search')}}">
                <ul class="navbar-nav mr-auto">
                    <li>
                        @php
                        use App\Models\Cart;
                        if(Auth::user())
                        $count = Cart::where('customer_id',Auth::user()->id)->get()->count();
                        else
                        $count = 0;
                        @endphp
                        <a href="{{route('carts.index')}}"  title="Cart">
                            <h3 style="margin-right: 15px; margin-top: 10px; color: white;">
                                <i class="fa-solid fa-cart-shopping"><span class='badge badge-warning' id='lblCartCount'>
                                        {{ $count }}
                                    </span></i>
                            </h3>
                        </a>
                    </li>
                </ul>

                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Name of Product" aria-label="Search" value="{{ Request::get('search') }}">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                @if(Auth::user())
                <a style="height: 40px; width: 40px; margin-left: 10px; border-radius: 19.5px;" href="{{route('users.show')}}">
                    <img style="height: 40px; width: 40px; border-radius: 19.5px;" src='{{asset("storage/" . Auth::user()->profile)}}' alt="Profile" title="Profile">
                </a>
                @else
                <button style="border-radius: 50%; padding: 10px 3px; margin-left: 10px; "><a style="text-decoration: none; color: black;" href="{{route('users.index')}}">LogIn</a></button>
                @endif
            </form>
        </div>
    </nav>

    <div>
        @yield('body')
    </div>

    <footer style="background-color: #3A3B3C; margin-top: 20px;" class="foot">
        <center>
            <h3 style="color: white;"><u>Follow Us On</u></h3>
            <div class="links">
                <a href="https://www.facebook.com/nabin.lamsal.737"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/nabinlamsal99"><i class="fa-brands fa-square-instagram"></i></a>
                <a href="https://twitter.com/nabinlamsal99"><i class="fa-brands fa-twitter"></i></a>
            </div>
            <h6 style="margin-bottom: 0; padding-bottom: 20px; color: white; text-align: center;">&copy; All rights reserved</h6>
        </center>
    </footer>
</body>

</html>