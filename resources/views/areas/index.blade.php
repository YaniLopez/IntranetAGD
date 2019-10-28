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
  <div class="row"><a href="{{ route('areas.create')}}" class="btn btn-primary">Crear</a></div>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Área</td>
          <td>Descripción</td>
          
        </tr>
    </thead>
    <tbody>
        @foreach($areas as $area)
        <tr>
            <td>{{$area->id_area}}</td>
            <td>{{$area->nom_area}}</td>
            <td>{{$area->descripcion_area}}</td>
            <td><a href="{{ route('areas.edit',$area->id_area)}}" class="btn btn-primary">Editar</a></td>
            <td>
                <form action="{{ route('areas.destroy', $area->id_area)}}" method="post">
                  @csrf
                  @method('DELETE')

                  <?php 
                  
                  if($area->valor === 'permite_borrar'){
                    ?> 
                      <button class="btn btn-danger" type="submit"> Borrar </button> 
                    <?php
                  } else {
                    ?> 
                      <button class="btn btn-default" disabled> Borrar </button> 
                    <?php
                  }
                  
                  ?>

                  
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection