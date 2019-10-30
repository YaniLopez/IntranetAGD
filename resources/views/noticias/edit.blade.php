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
      <form method="post" action="{{ route('noticias.update', $noticia->id_nov) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Título:</label>
          <input type="text" class="form-control" name="titulo_nov" value="{{ $noticia->titulo_nov }}" />
        </div>

          <div class="form-group">
              {!! Form::Label('id_tag', 'Tag:') !!}
              {!! Form::select('id_tag', $tags, $selectedTags, ['class' => 'form-control']) !!}
          </div>

          <div class="form-group">
              {!! Form::Label('id_prioridad', 'prioridad:') !!}
              {!! Form::select('id_prioridad', $prioridades, $selectedPri, ['class' => 'form-control']) !!}
          </div>
          <div class="form-group">
              {!! Form::Label('id_subarea', 'subarea:') !!}
              {!! Form::select('id_subarea', $subareas, $selectedSub, ['class' => 'form-control']) !!}
          </div>
          
        <div class="form-group">
          <label for="price">Descripción :</label>
          <input type="text" class="form-control" name="descripcion_nov" value="{{ $noticia->descripcion_nov }}" />
        </div>
        <div class="form-group">
          <label for="quantity">Imagen:</label>
          <input type="text" class="form-control" name="img_nov" value={{ $noticia->img_nov }} />
        </div>
        <div class="form-group">
        <img src="{{$noticia->img_nov}}" alt="Smiley face" width="400">
        </div>

        <button type="submit" class="btn btn-primary">Modificar</button>
      </form>
  </div>
</div>
@endsection