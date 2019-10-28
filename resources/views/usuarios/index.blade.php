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
  <div class="row"><a href="{{ route('usuarios.create')}}" class="btn btn-primary">Crear</a></div>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>NOMBRE</td>
          <td>LEGAJO</td>
          </tr>
    </thead>
    <tbody>
        @foreach($usuarios as $usuario)
        <tr>
            <td>{{$usuario->nom_user}}</td>
            <td>{{$usuario->leg_user}}</td>
            
            <td><a href="{{ route('usuarios.edit',$usuario->id_user)}}" class="btn btn-primary">Editar</a></td>
            <td>
                <form action="{{ route('usuarios.destroy',$usuario->id_user)}}" method="post">
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