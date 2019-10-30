<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubArea extends Model
{
  protected $table = 'tbl_subarea';

  public $timestamps = false;

  protected $primaryKey = 'id_subarea';

    protected $fillable = [
        'id_subarea',
        'nom_subarea',
        'descripcion_subarea'
      ];
}
