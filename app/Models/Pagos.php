<?php

namespace azimbron15\Models;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $table = 'pagos';
    protected $fillable = array('concepto', 'fecha_limite_pago', 'cantidad','created_at', 'updated_at');

    public function pagosConceptos(){
        return $this->belongsToMany('azimbron15\Models\PagoRealizado', 'pagos_conceptos', 'pagos_id','pagos_realizados_id');
    }

    public $timestamps = false;
}
