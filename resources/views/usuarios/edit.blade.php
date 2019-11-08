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
      </div>
    @endif
      <form method="post" action="{{ route('usuarios.update', $usuario->id_user) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">usuarios:</label>
          <input type="text" class="form-control" name="nom_user" value="{{ $usuario->nom_user }}" />
        </div>
        <div class="form-group">
          <label for="price">legajo:</label>
          <input type="text" class="form-control" name="leg_user" value="{{ $usuario->leg_user }}" />
        </div>
        <div class="form-group">
              {!! Form::Label('id_subarea', 'subarea:') !!}
              {!! Form::select('id_subarea', $subareas, $selectedSub, ['class' => 'form-control']) !!}
          </div>
          <div class="form-group">
              <label for="quantity">Mail:</label>
              <input type="text" class="form-control" name="Mail"/>
          </div>
          <div class="form-group">
              <label for="estado">Estado</label>
              <select class="form-control" name="estado">
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
              </select>
          </div>
          <div class="form-group">
          <label for="quantity">Imagen:</label>
          <input type="text" class="form-control" name="img_user" value={{ $usuario->img_user }} />
        </div>
        <div class="form-group">
        <img src="{{$usuario->img_user}}" alt="Smiley face" width="400">
        </div>

          <button type="submit" class="btn btn-primary">Modificar</button>
      </form>
  </div>
</div>
@endsection