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
      <form method="post" action="{{ route('usuarios.update', $usuario->id_user) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">usuarios:</label>
          <input type="text" class="form-control" name="nom_user" value={{ $usuario->nom_user }} />
        </div>
        <div class="form-group">
          <label for="price">legajo:</label>
          <input type="text" class="form-control" name="leg_user" value={{ $usuario->leg_user }} />
        </div>
        
        <button type="submit" class="btn btn-primary">Modificar</button>
      </form>
  </div>
</div>
@endsection