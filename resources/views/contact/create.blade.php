@extends('layouts.app')

@section('content')

<h1 class="text-center font-weight-light">Agregar nuevo contacto</h1><br>

<form action="{{ url('/contact/') }}" method="POST">
    @csrf
    
    <div class="row">
        <div class="offset-sm-4 col-sm-5">
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
    
    <div class="row">    
        <div class="offset-sm-4 col-sm-2">
            <label> Cédula: </label>
        </div>
        <div class="col-sm-3">
            <input type="text" class="form-control" name="dni" placeholder="Escribe la cédula" required>
        </div>
    </div>
    <br>    
    
    <div class="row">  
        <div class="offset-sm-4 col-sm-2">
            <label> Nombre: </label>
        </div>
        <div class="col-sm-3">
            <input type="text" class="form-control" name="name" placeholder="Escribe el nombre" required>
        </div>
    </div>
    <br>
    
    <div class="row">  
        <div class="offset-sm-4 col-sm-2">
            <label> Apellido 1: </label>
        </div>
        <div class="col-sm-3">
            <input type="text" class="form-control" name="lastName1" placeholder="Escribe el primer apellido" required>
        </div>
    </div>
    <br>
    
    <div class="row">  
        <div class="offset-sm-4 col-sm-2">
            <label> Apellido 2: </label>
        </div>
        <div class="col-sm-3">
            <input type="text" class="form-control" name="lastName2" placeholder="Escribe el segundo apellido" required>
        </div>
    </div>
    <br>
    
    <div class="row">  
        <div class="offset-sm-4 col-sm-2">
            <label> Correo: </label>
        </div>
        <div class="col-sm-3">
            <input type="email" class="form-control"  name="mail" placeholder="Escribe el correo" required>
        </div>
    </div>
    <br>
    
    <div class="row"> 
        <div class="offset-sm-6 col-sm-4 text-center">
            <input type="submit" class=" btn btn-sm btn-primary" name="create" value="Agregar">
            <button type="reset" class="btn btn-sm btn-danger">Cancelar</button>
        </div>
    </div>
        
    </div>
    
</form>

@endsection