@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    EDITAR
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
        <form method="post" action="{{ route('areas.update', $area->id_area) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="price">Área:</label>
          <input type="text" class="form-control" name="area" value={{ $area->nom_area }} />
        </div>
        <div class="form-group">
          <label for="quantity">Descripción:</label>
          <input type="text" class="form-control" name="descripcion" value={{ $area->descripcion_area}} />
        </div>
        <button type="submit" class="btn btn-primary">Modificar</button>
      </form>
  </div>
</div>
@endsection