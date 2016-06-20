<?php

namespace azimbron15\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';
    protected $fillable = array('nombre', 'email', 'contrasenha', 'condominio_id','created_at', 'updated_at');

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'contrasenha',
    ];

    public function getAuthPassword(){
        //your passwor field name
        return $this->contrasenha;
    }

    public function condominio(){
        return $this->belongsTo('azimbron15\Models\Condominio')->select(['id','departamento']);
    }
    public function roles(){
        return $this->belongsToMany('azimbron15\Models\Role', 'usuarios_roles', 'usuario_id', 'role_id');
    }

    public function is($roleName)
    {
        foreach ($this->roles as $roles)
        {
            if ($roles->name == $roleName)
            {
                return true;
            }
        }

        return false;
    }

    public $timestamps = false;
}
