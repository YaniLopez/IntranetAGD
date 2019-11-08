<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Subarea;
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
        $usuarios = Usuario::all();

        return view('usuarios.index', compact('usuarios'));

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
        ->orderBy('tbl_usuario.id_user');
        get();  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $subareas = Subarea::pluck('nom_subarea', 'id_subarea');

        return view ('usuarios.create', compact('subareas'));
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
        'usuario' => 'required',
        'legajo' => 'required',
        
      ]);
      $usuarios = new Usuario([
        'nom_user'=> $request->get('usuario'),
        'leg_user'=> $request->get('legajo'),
        'id_subarea'=> $request->get('id_subarea'),
        'pass_user'=> $request->get('contraseña'),
        'mail_user'=> $request->get('mail'),
        'fecha_creacion_user'=> $fecha,
        'fecha_edicion_user'=> $fecha,
        'fecha_login_user'=> $fecha,
        'estado_user'=> $request->get('estado'),
        'img_user'=> $request->get('imagen')
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

      $subareas = Subarea::pluck('nom_subarea', 'id_subarea');
      $selectedSub = Usuario::find($id)->id_subarea;

      if (!isset($selectedSub)){
        $selectedSub = 1; // Si no existe la relacion le coloco el primero
      }
      return view('usuarios.edit', compact('usuario', 'legajo', 'subareas','selectedSub', 'mail', 'estado', 'imagen'));
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
        'nom_user' => 'required',
        'leg_user' => 'required',
        
      ]);

      $usuarios = Usuario::find($id);
      $usuarios->nom_user = $request-> get('nom_user');
      $usuarios->leg_user = $request-> get('leg_user');
      $usuarios->id_subarea = $request->get('id_subarea');
      $usuarios->pass_user = $request-> get('pass_user');
      $usuarios->mail_user = $request-> get('mail_user');
      $usuarios->fecha_creacion_user = $fecha;
      $usuarios->fecha_edicion_user = $fecha;
      $usuarios->fecha_login_user = $fecha;
      $usuarios->estado_user = $request->get('estado_user');
      $usuarios->img_user = $request-> get('img_user');
      $usuarios->save();

      return redirect('/usuarios')->with('success', 'El usuario ha sido modificado');
      
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
