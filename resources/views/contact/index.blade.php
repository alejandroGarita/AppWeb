@extends('layouts.base')

@section('page_title')
    Contactos registrados
@endsection

@section('content')

    <a href="{{ url('/contact/create/') }}" class="btn btn-success active" role="button">Agregar nuevo</a>
    <br><br>

    <div class="table-responsive">
        <table class="table table-striped table-inverse">
            <thead class="thead-inverse">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido 1</th>
                    <th>Correo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>            
            @foreach ($contacts as $contact)
                <tr>
                    <td scope="row">{{ $contact->name }}</td>
                    <td>{{ $contact->lastName1 }}</td>
                    <td>{{ $contact->mail }}</td>
                    <td><a href="{{ url("/contact/$contact->id") }}">Ver</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection