<?php

namespace azimbron15\Models;

use Illuminate\Database\Eloquent\Model;

class Estatus extends Model
{
    protected $table = 'estatus';
    protected $fillable = array('estatus_descripcion','created_at', 'updated_at');

    public $timestamps = false;

    public function pagosRealizados()
    {
        return $this->hasMany('azimbron15\Models\PagoRealizado');
    }
}
