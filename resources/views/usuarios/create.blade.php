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
      </div><br />
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
          <button type="submit" class="btn btn-primary">Guardar</button>
      </form>
  </div>
</div>
@endsection