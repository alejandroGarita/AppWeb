@extends('layouts.app')

@section('content')
<form method="post" action="{{ url('files/upload') }}" enctype="multipart/form-data">
	@csrf			
    <h4 class="text-center">Cargar Multiple Archivos</h4>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Archivos</label>
        <div class="col-sm-8">
            <input type="file" id="files[]" name="files[]" multiple="">
        </div>
        
        <button type="submit" class="btn btn-primary">Agregar a la cola</button>
    </div>
    
</form>
@endsection
