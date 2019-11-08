@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Crear usuarios
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    @endif
      <form method="post" action="{{ route('usuarios.store') }}">
          <div class="form-group">
              {{ csrf_field() }}
              <label for="name">Usuario:</label>
              <input type="text" class="form-control" name="usuario"/>
          </div>
          <div class="form-group">
              {{ csrf_field() }}
              <label for="name">Legajo:</label>
              <input type="text" class="form-control" name="legajo"/>
          </div>
          <div class="form-group">
              {!! Form::Label('id_subarea', 'subarea:') !!}
              {!! Form::select('id_subarea', $subareas, NULL, ['class' => 'form-control'])!!}
          </div>
              <div class="form-group">
              <label for="quantity">Mail:</label>
              <input type="text" class="form-control" name="Mail"/>
          </div>
          <div class="form-group">
              <label for="estado">Estado</label>
              <select class="form-control" name="estado">
                <option value="1">Activo</option>
                <option value="2">Desactivado</option>
              </select>
          </div>
          <div class="form-group">
              <label for="quantity">Imagen:</label>
              <input type="text" class="form-control" name="imagen"/>
          </div>











          <button type="submit" class="btn btn-primary">Guardar</button>
          <a href="http://localhost/IntranetAGD/public/usuarios" class="btn btn-default">Cancel</a>
          
      </form>
  </div>
</div>
@endsection