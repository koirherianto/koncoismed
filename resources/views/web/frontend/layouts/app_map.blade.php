<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="Gistaru, samarinda, tata ruang, gistaru samarinda" />
<meta name="description" content="Gistaru - GIS Tata Ruang Wilaya Samarinda" />
<meta name="author" content="britech.id" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>Kawal Data</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{asset('image/gelora.png')}}" />

<!-- font -->
<link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,500,500i,600,700,800,900|Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
{{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700,800">--}}

    @include('web.frontend.layouts.css')

    @yield('css')

</head>

<body>


<div class="wrapper">

    <!--=================================
     preloader -->

    <div id="pre-loader">
        <img src="assets/webster/images/pre-loader/loader-01.svg" alt="">
    </div>

    <!--=================================
     preloader -->

     @include('web.frontend.layouts.header')

     @yield("content")

     @include("web.frontend.layouts.footer")
</div>

     @include('layouts.js')

     @include("web.frontend.layouts.js")

     @yield("scripts")

</body>
</html>
