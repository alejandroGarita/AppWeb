
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    @yield('css')  

    <title> Sistema de envio de comprobantes</title>

</head>
<body>

    <div class="container">

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
            
                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-body">
                        <p class="text-center">Cargando...</p>
                    </div>

                </div>
            
            </div>
        </div>

        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <a class="navbar-brand" href="{{ url('/home/') }}">Inicio</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                @guest @else
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/contact/') }}">Contactos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/messages/addFiles') }}">Comprobantes</a>
                    </li>
                </ul>
                @endguest
                
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Salir
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav><br>

        <h1 class="text-center font-weight-light">@yield('title')</h1><br>

        <div class="row">
            <div class="offset-sm-3 col-sm-6">
                @if (session('ok'))
                    <div class="alert alert-success">
                        {{ session('ok') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="offset-sm-3 col-sm-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        @yield('content')


        <br><br><br>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function(){
    
            $(".load").click(function(){
                $("#myModal").modal({
                    keyboard: false,
                    backdrop: 'static'
                });    
            });
    
        });
    
        function loadOnSubmit(){
            $("#myModal").modal({
                keyboard: false,
                backdrop: 'static'
            }); 
        }
    </script>
    @yield('scripts')
</body>
    
</html>
