@extends('layouts.base')

@section('page_title')
    Contactos registrados
@endsection

@section('content')

    <a href="{{ route('contact.create') }}" class="btn btn-success active" role="button">Agregar nuevo</a>
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
                    <td>
                        <a href="{{ route('contact.edit', $contact->id) }}">
                            <button type="button" class="btn btn-primary">Editar</button>
                        </a>
                        <a href="#">
                            <button type="button" class="btn btn-danger">Eliminar</button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection