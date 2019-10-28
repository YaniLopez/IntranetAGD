<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use DB; 

class AreaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $areas = DB::table('tbl_area')
        ->select('tbl_area.id_area','tbl_area.nom_area','tbl_area.descripcion_area',
        DB::raw('(case 
        when id_jefe is NULL or id_subarea is NULL then "permite_borrar"
          else "no_permite_borrar"
        end) AS valor'))
        ->leftJoin('tbl_subarea','tbl_subarea.id_area','=','tbl_area.id_area')
        ->leftJoin('tbl_jefe','tbl_jefe.id_area','=','tbl_area.id_area')
        //->groupBy('tbl_area.id_area')
        ->orderBy('tbl_area.id_area', 'desc')
        ->get();
    
        return view('areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('areas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'area'=> 'required',
        'descripcion' => 'required' 
      ]);
      $areas = new Area([
        'nom_area'=> $request->get('area'),
        'descripcion_area'=> $request->get('descripcion')
      ]);
      $areas->save();
      return redirect('/areas')->with('success', 'Se ha guardado una nueva área');
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
        $area = Area::find($id);

        return view('areas.edit', compact('area'));
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
      $request->validate([
        'area'=> 'required',
        'descripcion' => 'required'
      ]);

      $areas = Area::find($id);
      $areas->nom_area = $request->get('area');
      $areas->descripcion_area = $request->get('descripcion');
      $areas->save();

      return redirect('/areas')->with('success', 'Área modificada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::find($id);
        $area->delete();

      return redirect('/areas')->with('success', 'El área fue eliminada correctamente ');
    }
}
