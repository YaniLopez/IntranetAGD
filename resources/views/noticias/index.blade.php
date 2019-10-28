@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <div class="row"><a href="{{ route('noticias.create')}}" class="btn btn-primary">Crear</a></div>

  <table class="table table-striped">
    <thead>
        <tr>
          <td>Id</td>
          <td>Descripción</td>
          <td>Localidad</td>
          <td colspan="2">Imagen</td>
        </tr>
    </thead>
    <tbody>
        @foreach($noticias as $noticia)
        
        <tr>
            <td>{{$noticia->id_nov}}</td>
            <td>{{$noticia->titulo_nov}}</td>
            <td>{{$noticia->descripcion_nov}}</td>
            <td>
            <img src="{{$noticia->img_nov}}" alt="Smiley face" height="42" width="50">
            </td>
            <td><a href="{{ route('noticias.edit',$noticia->id_nov)}}" class="btn btn-primary">Editar</a></td>
            <td>
                <form action="{{ route('noticias.destroy', $noticia->id_nov)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Borrar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection