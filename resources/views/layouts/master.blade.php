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

      <div id='app'></div><!-- this is to silence the Vue cannot find error, until Iget round to using Vue -->

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
      <script>
          $(function() {
              // $(document).tooltip();
              $(".closeDiv").click(function(){
                  $(event.target).closest("div").remove();
              });
          });
      </script>
      @stack('scripts')

      @yield('scripts')

</body>
</html>
