@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Crear Noticia
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
      <form method="post" action="{{ route('noticias.store') }}">
          <div class="form-group">
              {{ csrf_field() }}
              <label for="name"> Título:</label>
              <input type="text" class="form-control" name="titulo"/>
          </div>

          <div class="form-group">
              {!! Form::Label('id_tag', 'Tag:') !!}
              {!! Form::select('id_tag', $tags, NULL, ['class' => 'form-control']) !!}
          </div>

          <div class="form-group">
              <label for="price">Descripción :</label>
              <input type="text" class="form-control" name="descripcion"/>
          </div>
          <div class="form-group">
              <label for="quantity">Imagen:</label>
              <input type="text" class="form-control" name="imagen"/>
          </div>

          <div class="form-group">
              <label for="estado">Estado</label>
              <select class="form-control" name="estado">
                <option value="1">Publicada</option>
                <option value="2">No publicada</option>
              </select>
          </div>

          <button type="submit" class="btn btn-primary">Guardar</button>
      </form>
  </div>
</div>
@endsection