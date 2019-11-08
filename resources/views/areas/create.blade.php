@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
  Crear Area
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
      <form method="post" action="{{ route('areas.store') }}">
      {{ csrf_field() }}
      <div class="form-group">
              <label for="price">Area:</label>
              <input type="text" class="form-control" name="area"/>
          </div>

          <div class="form-group">
              <label for="price">Descripción:</label>
              <input type="text" class="form-control" name="descripcion"/>
          </div>

          <button type="submit" class="btn btn-primary">Guardar</button>
      </form>
  </div>
</div>
@endsection