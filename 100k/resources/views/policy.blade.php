<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>100kChallenge</title>
    <link rel='icon' href="{{asset('default-imgs/100k-footer.png')}}"/>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="module" src="{{asset('js/extra/Scanner.js')}}" defer></script>
    <script type="module" src="{{asset('js/extra/100k.js')}}" defer></script>
    <script src="{{ asset('js/extra/anime.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/extra.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Google+Sans:200,300,400,500,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,700,800,900" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>
<style> 
  body{
    background:white !important;
    font-family: Raleway, sans-serif;
  }
</style>
<body> 
  <div id="app">
    <center>
    <div class=""> 
        <img src="{{asset('default-imgs/good-logo.png')}}" class="logo-css" style="margin-left:0px !important" />
    </div>

   
    <h1 style="font-size:3.25rem">Policy</h1>
    <p style="text-align:justify; font-weight:500; text-transform:uppercase;width:50%; font-size:20px;"> 
      this is the official webiste of the 100kChallenge. Webiste information are transfered over certified secure hypertext protocols, and is entirely safe to use. 
      Sign up information and registration details are only required by the webiste only for future communication and user count
    </p>

    </center>

</body> 


