<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prioridad extends Model
{
  protected $table = 'tbl_prioridad';

  public $timestamps = false;

  protected $primaryKey = 'id_prioridad';

    protected $fillable = [
        'id_prioridad',
        'nom_prioridad'
      ];
}
