<!DOCTYPE html>
<html lang="zh-CN">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>lufficc</title>
      <link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
      <link href="https://cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
      <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css">
   </head>
   <body class="home-template">
      @include('layouts.header')
      <!-- end of header -->
      @include('layouts.nav')
      <!-- end of nav -->
      <section class="content-wrap">
         <div class="container">
            @yield("content")
         </div>
      </section>
      
      @include('layouts.footer')
      <script src="http://cdn.bootcss.com/jquery/3.1.0/jquery.min.js"></script>
      <script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      
   </body>
</html>