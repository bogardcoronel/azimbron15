<?php

namespace azimbron15\Http\Controllers;

use azimbron15\Events\UsuarioCreadoEvent;
use azimbron15\Models\Condominio;
use azimbron15\Models\Role;
use azimbron15\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;

use azimbron15\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
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


        $roles = Role::find($request->input('role'));

        $roles->users()->create([
            'nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
            'contrasenha' => Hash::make($request->input('password')),
            'condominio_id' => $request->input('condominio'),
            'created_at' => Carbon::now()
        ]);

        UsuarioCreadoEvent::fire(Usuario::where('email', 1)->first());

        \Session::flash('success','Usuario creado exitosamente.');
        
        return Redirect::to('usuarios/create');
    }

    public function create()
    {
        $roles = Role::lists('name', 'id');
        $condominio = Condominio::lists('departamento', 'id');
        return view('usuarios.create',compact('roles','condominio'));
    }

    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }
}
