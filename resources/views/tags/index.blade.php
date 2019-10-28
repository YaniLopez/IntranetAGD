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
  <div class="row"><a href="{{ route('tags.create')}}" class="btn btn-primary">Crear</a></div>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Tags</td>
          
        </tr>
    </thead>
    <tbody>
        @foreach($tags as $tag)
        <tr>
      <td>{{$tag->nom_tag}}</td>
          <td><a href="{{ route('tags.edit',$tag->id_tag)}}" class="btn btn-primary">Editar</a></td>
            <td>
            <form action="{{ route('tags.destroy', $tag->id_tag)}}" method="post">
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