<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use DB; 

class UsuarioController extends Controller
{
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$usuarios = Usuario::all();
        $usuarios = DB::table('tbl_usuario')
        ->select('tbl_usuario.id_user','tbl_usuario.nom_user','tbl_usuario.leg_user',
        DB::raw('(case 
        when tbl_usuario.id_user is NULL then "permite_borrar"
          else "no_permite_borrar"
        end) AS valor'))
        ->leftJoin ('tbl_subarea','tbl_subarea.id_subarea','=','tbl_usuario.id_subarea')
        ->leftJoin ('tbl_novedad','tbl_novedad.id_user','=','tbl_usuario.id_user')
        ->leftJoin ('tbl_user_rol','tbl_user_rol.id_user','=','tbl_usuario.id_user')
        
        //->groupBy('tbl_area.id_area')
        ->orderBy('tbl_usuario.id_user')
        ->get();

        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
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
        'usuario' => 'required',
        'legajo' => 'required'
      ]);
      $usuarios = new Usuario([
        'nom_user'=> $request->get('usuario'),
        'leg_user'=> $request->get('legajo'),
        'id_subarea'=> 1
      ]);
      $usuarios->save();
      return redirect('/usuarios')->with('success', 'Se ha guardado un nuevo usuario');
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
        $usuario = Usuario::find($id);

        return view('usuarios.edit', compact('usuario'));
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
        'usuario' => 'required',
        'legajo' => 'required'
      ]);

      $usuarios = Usuario::find($id);
      $usuarios->nom_user = $request->get('usuario');
      $usuarios->leg_user = $request->get('legajo');
      $usuarios->save();

      return redirect('/usuarios')->with('success', 'El usuario ha sido modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuarios = Usuario::find($id);
        $usuarios->delete();

      return redirect('/usuarios')->with('success', 'El usuario fue eliminado correctamente');
    }   
}
