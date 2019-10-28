<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use DB;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $tags = Tag::all();    
      
      return view('tags.index', compact('tags'));

      $tags = DB::table('tbl_tag')
      ->select( 'tbl_tag.id_tag','tbl_tag.nom_tag',
	DB::raw('(case 
    	when id_nov is NULL then "permite_borrar"
          else "no_permite_borrar"
	        end) AS valor'))
    ->leftJoin('tbl_novedad','tbl_novedad.id_tag','=','tbl_tag.id_tag')
    ->orderBy('tbl_tag.id_tag')
    ->get();
          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
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
              'tags'=> 'required'
            ]);
            $tags = new Tag([
              'nom_tag' => $request->get('tags')
             ]);
            $tags->save();
            return redirect('/tags')->with('success', 'Tag guardado correctamente');
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
        $tags = tag::find($id);

        return view('tags.edit', compact('tags'));
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
          'nom_tag'=>'required'
        ]);

        $tags = tag::find($id);
        $tags->nom_tag = $request->get('nom_tag');
        $tags->save();
  
        return redirect('/tags')->with('success', 'Tag Modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tags = Tag::find($id);
        $tags->delete();

      return redirect('/tags')->with('success', 'Tag eliminado correctamente');
    }
}
