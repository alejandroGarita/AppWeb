@extends('layouts.base')

@section('content')

<h1 class="text-center font-weight-lighter">Iniciar sesión</h1><br>
<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="row">    
        <div class="offset-sm-4 col-sm-2">
            <label> Correo: </label>
        </div>
        <div class="col-sm-3">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <br> 

    <div class="row">    
        <div class="offset-sm-4 col-sm-2">
            <label> Contraseña: </label>
        </div>
        <div class="col-sm-3">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <br> 
    
    <div class="row"> 
        <div class="offset-sm-5 col-sm-3 text-center">
            <button type="submit" class=" form-control btn btn-primary">Iniciar sesión</button>
        </div>
    </div>
    

    

</form>
@endsection
