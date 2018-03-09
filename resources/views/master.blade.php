<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>
      @yield('title')
    </title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}" />

    <style>
      @yield('styles')
    </style>


  </head>
  <body>

      @include('includes.nav')

      <div role="main" class="container">
          @include('includes.messages')
          <div class="starter-template">

          @yield('mainContent')

          </div>
      </div>

      <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
      <script>
          CKEDITOR.replace( 'article-ckeditor', {
              customConfig: '/vendor/unisharp/laravel-ckeditor/my_config.js'
          });
      </script>

</body>
</html>
