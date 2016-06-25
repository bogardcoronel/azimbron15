<?php

namespace azimbron15\Models;

use Illuminate\Database\Eloquent\Model;

class PagoRealizado extends Model
{
    protected $table = 'pagos_realizados';
    protected $fillable = array('comentarios', 'cantidad_pagada', 'fecha_reporte_pago', 'fecha_de_pago', 'condominio_id',
        'estatus_id','created_at', 'updated_at');

    public function condominio(){
        return $this->belongsTo('azimbron15\Models\Condominio','condominio_id')->select(['id','departamento']);
    }

    public function estatus(){
        return $this->belongsTo('azimbron15\Models\Estatus','estatus_id')->select(['id','estatus_descripcion']);
    }

    public function evidencias()
    {
        return $this->hasMany('azimbron15\Models\Evidencia');
    }
    
    public function pagosConceptos(){
        return $this->belongsToMany('azimbron15\Models\Pagos', 'pagos_conceptos', 'pagos_realizados_id', 'pagos_id');
    }

    public $timestamps = false;
}
