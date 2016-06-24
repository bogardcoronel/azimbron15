<?php
/**
 * Created by IntelliJ IDEA.
 * User: Bogard
 * Date: 21/06/2016
 * Time: 12:49 PM
 */

namespace azimbron15\Models;


use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    protected $table = 'evidencia';
    protected $fillable = array('nombre_archivo','mime','tamanho_archivo','evidencia','pago_realizado_id','created_at', 'updated_at');

    public $timestamps = false;

    public function pagoRealizado(){
        return $this->belongsTo('azimbron15\Models\PagoRealizado','pago_realizado_id')->select(['id','descripcion_pago']);
    }
}