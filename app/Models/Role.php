<?php

namespace azimbron15\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $table = 'roles';
    protected $fillable = array('name','created_at', 'updated_at');

    public $timestamps = false;

    public function users(){
        return $this->belongsToMany('azimbron15\Models\Usuario','usuarios_roles', 'role_id', 'usuario_id');
    }
}
