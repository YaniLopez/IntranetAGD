<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
  protected $table = 'tbl_area';

  public $timestamps = false;

  protected $primaryKey = 'id_area';

    protected $fillable = [
        'nom_area',
        'descripcion_area'
      ];
}
