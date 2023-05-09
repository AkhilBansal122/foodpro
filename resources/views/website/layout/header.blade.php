<!DOCTYPE html>
<html lang="en">

<head>

@include('flash-message')
<?php
 $directoryURI = $_SERVER['REQUEST_URI'];
  $path = parse_url($directoryURI, PHP_URL_PATH);
  $components = explode('/', $path);

  $uri1= isset($components[2]) ? $components[2] :'';

 $uri2 = isset($components[3]) ? $components[3] :'';
$checked = false;

if(substr($uri1, 0, 4)==="TBL-")
{
    $checked = true;    
}

?>
<meta charset="utf-8">
    <title>Restoran</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="{{ asset('public/assets/website/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('public/assets/website/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{asset('public/assets/website/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{asset('public/assets/website/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />


 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('public/assets/website/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('public/assets/website/css/style.css') }}" rel="stylesheet">
</head>
<style>
    element {
	background-color: #fff !important;
	border-color: #fff !important;
}

         .sidebar{position: fixed;}
         .main_div{display: flex;}
         .sliderimg{height: 50vh !important;}
         .bttn {display: flex; justify-content: space-evenly; margin-top: 20px;}
         .bttn button{border: none; border-bottom: 2px solid grey; padding: 2px 15px; background-color: transparent;}
         .bttn button:hover{border-bottom: 3px solid orange;}
   
</style>
<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Restoran</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                @if((auth()->user()) && (auth()->user()->is_admin==5) && $checked==true)
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="{{url('/')}}/{{auth()->user()->table_id}}" class="nav-item nav-link {{(($uri1==auth()->user()->table_id) && $uri2=='') ? 'active' :'' }}">Home</a>
                        <a href="{{url('/')}}/{{auth()->user()->table_id}}/about" class="nav-item nav-link {{$uri2=='about' ? 'active' :'' }}">About</a>
                        <a href="{{url('/')}}/{{auth()->user()->table_id}}/service" class="nav-item nav-link {{$uri2=='service' ? 'active' :'' }}">Service</a>
                        <a href="{{url('/')}}/{{auth()->user()->table_id}}/menu" class="nav-item nav-link {{$uri2=='menu' ? 'active' :'' }}">Menu</a>
                        <!-- <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="{{url('/')}}/{{auth()->user()->table_id}}/booking" class="dropdown-item {{$uri2=='booking' ? 'active' :'' }}">Booking</a>
                                <a href="{{url('/')}}/{{auth()->user()->table_id}}/team" class="dropdown-item {{$uri2=='booking' ? 'active' :'' }}">Our Team</a>
                                <a href="{{url('/')}}/{{auth()->user()->table_id}}/testimonial" class="dropdown-item {{$uri2=='booking' ? 'active' :'' }}">Testimonial</a>
                            </div>
                        </div> -->
                        <a href="{{url('')}}/{{auth()->user()->table_id}}/contact" class="nav-item nav-link {{$uri2=='contact' ? 'active' :'' }}">Contact</a>
                    </div>
                    <a href="{{route('customlogout')}}" class="btn btn-primary py-2 px-4">Logout</a>
                    <!-- <a href="{{url('/')}}/{{auth()->user()->table_id}}/cartItem" style="" class="btn btn-primary py-2 px-4 "><i class="bi bi-cart-fill"></i></a> -->
                </div>
                @elseif($checked==false && $restaurentName!='')
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="{{url('/')}}/{{$restaurentName}}" class="nav-item nav-link {{(($uri1==$restaurentName) && $uri2=='') ? 'active' :'' }}">Home</a>
                        <a href="{{url('/')}}/{{$restaurentName}}/about" class="nav-item nav-link {{$uri2=='about' ? 'active' :'' }}">About</a>
                        <a href="{{url('/')}}/{{$restaurentName}}/service" class="nav-item nav-link {{$uri2=='service' ? 'active' :'' }}">Service</a>
                        <a href="{{url('/')}}/{{$restaurentName}}/menu" class="nav-item nav-link {{$uri2=='menu' ? 'active' :'' }}">Menu</a>
                        <!-- <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="{{url('/')}}/booking" class="dropdown-item {{$uri2=='booking' ? 'active' :'' }}">Booking</a>
                                <a href="{{url('/')}}/team" class="dropdown-item {{$uri2=='booking' ? 'active' :'' }}">Our Team</a>
                                <a href="{{url('/')}}/testimonial" class="dropdown-item {{$uri2=='booking' ? 'active' :'' }}">Testimonial</a>
                            </div>
                        </div> -->
                        <a href="{{url('')}}/{{$restaurentName}}/contact" class="nav-item nav-link {{$uri2=='contact' ? 'active' :'' }}">Contact</a>
                    </div>
                    <!-- <a href="{{route('customlogout')}}" class="btn btn-primary py-2 px-4">Login</a>
                    <a href="{{url('/')}}/cartItem" style="" class="btn btn-primary py-2 px-4 "><i class="bi bi-cart-fill"></i></a> -->
                </div>
                @endif
                            </nav>