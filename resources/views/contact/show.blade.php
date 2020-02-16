@extends('layouts.base')

@section('page_title')
    Datos del contacto
@endsection

@section('secondary_text')
    <h5 class="text-center">Nombre: {{ $contact->name . ' ' . $contact->lastName1 }}</h5>
    <h5 class="text-center">Correo: {{ $contact->mail }}</h5>
@endsection

@section('content')

    
    <h4 class="text-center">¿Desea eliminar este contacto?</h4>

    <div class="row"> 
        <div class="offset-sm-4 col-sm-4 text-center">
            <form action="{{ route('contact.destroy', $contact->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class=" btn btn-sm btn-danger" name="create" value="Eliminar">
                <a href="{{ url('/contact/') }}"><button type="button" class="btn btn-sm btn-secondary">Cancelar</button></a>
            </form>
        </div>
    </div>

@endsection