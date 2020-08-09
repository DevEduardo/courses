<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Gestion de Cursos</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}?v=1.6.0" rel="stylesheet">
    </head>
    <body style="background-color: #dcdde1">
        <div class="flex-center position-ref full-height">
            <div class="content">
                <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #273c75">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                      <a class="navbar-brand" href="#">Gestion de Cursos</a>
                      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item @if(Route::has('/')) 'active' @endif">
                          <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item @if(Route::has('students')) 'active' @endif" >
                          <a class="nav-link" href="#">Estudiantes</a>
                        </li>
                        <li class="nav-item @if(Route::has('courses')) 'active' @endif">
                          <a class="nav-link" href="#">Cursos</a>
                        </li>
                      </ul>
                    </div>
                </nav>
                <div id='app'>
                  @yield('content')
                </div>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}?v=1.89.0"></script>
    </body>
</html>
