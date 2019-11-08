<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Noticia;
use App\Tag;
use App\Prioridad;
use App\Subarea;

class NoticiaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticias = Noticia::all();

        return view('noticias.index', compact('noticias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $tags = Tag::pluck('nom_tag', 'id_tag');
      $prioridades = Prioridad::pluck('nom_prioridad', 'id_prioridad');
      $subareas = Subarea::pluck('nom_subarea', 'id_subarea');

      return view('noticias.create', compact('subareas','tags', 'prioridades'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $fecha = date("Y/m/d");

      $request->validate([
        'titulo'=>'required',
        'descripcion'=> 'required',
        'imagen' => 'required'
      ]);
      $noticia = new Noticia([
        'titulo_nov' => $request->get('titulo'),
        'descripcion_nov'=> $request->get('descripcion'),
        'img_nov'=> $request->get('imagen'),
        'fecha_creacion_nov' => $fecha,
        'fecha_edicion_nov'=> $fecha,
        'estado_nov' => $request->get('estado'),
        'id_subarea' => $request->get('id_subarea'),
        'id_prioridad' => $request->get('id_prioridad'),
        'id_tag' => $request->get('id_tag'),
        'id_user' => 1
      ]);
      $noticia->save();
      return redirect('/noticias')->with('success', 'Se ha guardado una nueva noticia');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $noticia = Noticia::find($id);

        $tags = Tag::pluck('nom_tag', 'id_tag');
        $selectedTags = Noticia::find($id)->id_tag;

        $prioridades = Prioridad::pluck('nom_prioridad', 'id_prioridad');
        $selectedPri = Noticia::find($id)->id_prioridad;

        $subareas = Subarea::pluck('nom_subarea', 'id_subarea');
        $selectedSub = Noticia::find($id)->id_subarea;

        if (!isset($selectedTags)){
          $selectedTags = 1; // Si no existe la relacion le coloco el primero
        }

        if (!isset($selectedPri)){
          $selectedPri = 1; // Si no existe la relacion le coloco el primero
        }

        if (!isset($selectedSub)){
          $selectedSub = 1; // Si no existe la relacion le coloco el primero
        }

        return view('noticias.edit', compact('noticia','tags','selectedTags','subareas','selectedSub','prioridades','selectedPri'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      $fecha = date("Y/m/d");

      $request->validate([
        'titulo_nov'=>'required',
        'descripcion_nov'=> 'required',
        'img_nov' => 'required'
      ]);

      $noticia = Noticia::find($id);
      $noticia->titulo_nov = $request->get('titulo_nov');
      $noticia->descripcion_nov = $request->get('descripcion_nov');
      $noticia->img_nov = $request->get('img_nov');
      $noticia->fecha_creacion_nov = $fecha;
      $noticia->fecha_edicion_nov = $fecha;
      $noticia->estado_nov = $request->get('estado');
      $noticia->id_subarea = $request->get('id_subarea');
      $noticia->id_prioridad = $request->get('id_prioridad');
      $noticia->id_tag = $request->get('id_tag');
      $noticia->id_user = 1;
      $noticia->save();

      return redirect('/noticias')->with('success', 'Noticia modificada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $noticia = Noticia::find($id);
        $noticia->delete();

      return redirect('/noticias')->with('success', 'La noticia fue eliminada correctamente');
    }
}
