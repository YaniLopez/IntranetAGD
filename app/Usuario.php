<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'tbl_usuario';

  public $timestamps = false;

  protected $primaryKey = 'id_user';

    protected $fillable = [
        'id_user',
        'nom_user',
        'leg_user',
        'id_subarea',
        'pass_user',
        'mail_user',
        'fecha_creacion_user',
        'fecha_edicion_user',
        'fecha_login_user',
        'estado_user',
        'img_user'
    ];
}
