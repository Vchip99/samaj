<!DOCTYPE html>
<html lang="en">
  <head>
    @yield('header-title')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/homestyle.css')}}">
    <style type="text/css">
      @media only screen and (max-width: 768px){
        .col-xs-1 {width: 8.33%;}
        .col-xs-2 {width: 16.66%;}
        .col-xs-3 {width: 25%;}
        .col-xs-4 {width: 33.33%;}
        .col-xs-5 {width: 41.66%;}
        .col-xs-6 {width: 50%;}
        .col-xs-7 {width: 58.33%;}
        .col-xs-8 {width: 66.66%;}
        .col-xs-9 {width: 75%;}
        .col-xs-10 {width: 83.33%;}
        .col-xs-11 {width: 91.66%;}
        .col-xs-12 {width: 100%;}
      }
    </style>
    @yield('header-css')
    @yield('header-js')
  </head>
  <body >
  @yield('content')
<script type="text/javascript">
   $(document).ready(function(){
        setTimeout(function() {
          $('.alert-success').fadeOut('fast');
        }, 10000); // <-- time in milliseconds
    });
</script>
  </body>
</html>