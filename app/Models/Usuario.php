<?php

namespace azimbron15\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Usuario extends Authenticatable implements  AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use  Authorizable, CanResetPassword;

    protected $table = 'usuarios';
    protected $fillable = array('nombre', 'email', 'contrasenha', 'condominio_id','created_at', 'updated_at');

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'contrasenha','remember_token',
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
