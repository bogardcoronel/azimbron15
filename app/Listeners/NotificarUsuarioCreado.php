<?php

namespace azimbron15\Listeners;

use azimbron15\Events\UsuarioCreadoEvent;
use azimbron15\Models\Usuario;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NotificarUsuarioCreado
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UsuarioCreadoEvent  $event
     * @return void
     */
    public function handle(UsuarioCreadoEvent $event)
    {
        $usuario = Usuario::find($event->usuarioCreado->id)->toArray();
        $usuario['contrasenhaDes'] = $event->contrasenha;

        Mail::send('emails.usuarioCreado', $usuario, function ($message) use ($usuario){

            $message->from('no-reply@angelzimbron15.esy.es', 'Usuario creado');

            $message->to($usuario['email'])->subject('Activación de cuenta en sistema "Tu espacio Ángel Zimbrón"');

        });
    }
}
