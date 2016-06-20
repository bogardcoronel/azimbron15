<?php

namespace azimbron15\Models;

use Illuminate\Database\Eloquent\Model;

class Condominio extends Model
{
    protected $table = 'condominios';
    protected $fillable = array('departamento','created_at', 'updated_at');
    
    public $timestamps = false;

    public function usuarios()
    {
        return $this->hasMany('azimbron15\Models\Usuario');
    }

    public function pagosRealizados()
    {
        return $this->hasMany('azimbron15\Models\PagoRealizado');
    }
}
