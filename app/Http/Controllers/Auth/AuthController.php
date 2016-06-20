<?php

namespace azimbron15\Http\Controllers\Auth;

use azimbron15\Models\Condominio;
use azimbron15\Models\Role;
use azimbron15\Models\Usuario;
use azimbron15\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'contrasenha' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return Usuario::create([
            'nombre' => $data['name'],
            'email' => $data['email'],
            'contrasenha' => bcrypt($data['password']),
        ]);
    }
    
    public function register()
    {
        $rules = [
            'nombre' => 'required|min:2|unique:usuarios',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|confirmed|min:6',
        ];

        $input = Input::only(
            'nombre',
            'email',
            'password',
            'password_confirmation'
        );

        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }


        $roles = Role::find(Input::get('role'));

        $roles->users()->create([
            'nombre' => Input::get('nombre'),
            'email' => Input::get('email'),
            'contrasenha' => Hash::make(Input::get('password')),
            'condominio_id' => Input::get('condominio')
        ]);


        
        \Session::flash('success','Usuario creado exitosamente.');
        return redirect()->route("home");
    }

    public function registration()
    {
        $roles = Role::lists('name', 'id');
        $condominio = Condominio::lists('departamento', 'id');
        return view('auth/register',compact('roles','condominio'));
    }
}
