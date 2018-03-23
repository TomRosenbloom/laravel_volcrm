<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
      @yield('title')
    </title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}" />

    <style>
      @yield('styles')
    </style>


  </head>
  <body>

      @include('includes.navbar')

      <div role="main" class="container">

          @if(Request::is('/'))
              @include('includes.showcase')
          @endif

          @include('includes.messages')

          <div class="starter-template">
              @yield('content')
          </div>

      </div>

      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}"></script>

      <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
      <script>
          CKEDITOR.replace( 'article-ckeditor', {
              customConfig: '/vendor/unisharp/laravel-ckeditor/my_config.js'
          });
      </script>

</body>
</html>
