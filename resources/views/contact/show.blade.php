@extends('layouts.app')

@section('title')
Información del contacto
@endsection

@section('content')
    
    <div class="jumbotron">
        <p class="lead text-center">
            <h5 class="text-center">Nombre: {{ $contact->name . ' ' . $contact->lastName1 }}</h5>
        <h5 class="text-center">Correo: {{ $contact->mail }}</h5>
        </p>
    </div>
    
    <h4 class="text-center">¿Desea eliminar este contacto?</h4>

    <div class="row"> 
        <div class="offset-sm-4 col-sm-4 text-center">
            <form action="{{ route('contact.destroy', $contact->id) }}" onsubmit="loadOnSubmit()" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class=" btn btn-sm btn-danger" name="create" value="Eliminar">
                <a href="{{ url('/contact/') }}"><button type="button" class="btn btn-sm btn-secondary load">Cancelar</button></a>
            </form>
        </div>
    </div>

@endsection