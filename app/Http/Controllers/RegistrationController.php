<?php

namespace azimbron15\Http\Controllers;

use azimbron15\Http\Requests;

use azimbron15\Models\Usuario;
use Illuminate\Support\Facades\Input;

class RegistrationController extends Controller
{
    
    public function register()
    {
        $rules = [
            'name' => 'required|min:6|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ];

        $input = Input::only(
            'name',
            'email',
            'password',
            'password_confirmation'
        );

        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $confirmation_code = str_random(30);

        Usuario::create([
            'nombre' => Input::get('name'),
            'email' => Input::get('email'),
            'contrasenha' => Hash::make(Input::get('password')),
            'confirmation_code' => $confirmation_code
        ]);

        Mail::send('email.verify', $confirmation_code, function($message) {
            $message->to(Input::get('email'), Input::get('username'))
                ->subject('Verify your email address');
        });

        Flash::message('Thanks for signing up! Please check your email.');

        return Redirect::home();
    }
}
