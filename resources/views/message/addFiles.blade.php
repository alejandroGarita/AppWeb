@extends('layouts.app')

@section('title')
    Enviar comprobantes
@endsection

@section('content')

<form method="post" action="{{ url('messages/storageFiles') }}" enctype="multipart/form-data">
	@csrf			

    <div class="form-group">
        <label class="col-sm-2 control-label">Seleccionar archivos</label>
        <div class="col-sm-8">
            <input type="file" class="" id="files[]" name="files[]" multiple="" accept="application/pdf,image/jpeg" required>
        </div>
        
        <br>
        <button type="submit" class="btn btn-primary">Agregar a la cola</button>
    </div>
    
    @if ($messages->count() > 0)
    <br><h3 class="text-center font-weight-light">Cola de envío</h3><br><br>

    <div class="table-responsive">
        <table class="table table-striped table-inverse">
            <thead class="thead-inverse">
                <tr>
                    <th>Nombre del archivo</th>
                    <th>Destinatario</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $message)
                    <tr>
                        <td scope="row">{{ $message->name }}</td>
                        <td>{{ $message->contact->mail }}</td>
                        <td>
                            <a href="{{ url("/messages/$message->id/destroy/") }}">
                                <button type="button" class="btn btn-danger">Eliminar</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach

                    <tr>
                        <td scope="row"></td>
                        <td><a href="{{ url('/messages/sendMails/') }}" class="btn btn-primary active" role="button">Enviar comprobantes</a></td>
                        <td><a href="{{ url('/messages/clear/') }}" class="btn btn-danger" role="button">Vaciar cola</a></td>
                    </tr>
                </tbody>
        </table>
    </div>
    
    @else
    <br><h3 class="text-center font-weight-light">La cola de envíos está vacía</h3><br><br>
    @endif

</form>

@endsection
