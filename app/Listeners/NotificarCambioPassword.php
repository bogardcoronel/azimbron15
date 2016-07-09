<?php

namespace azimbron15\Listeners;

use azimbron15\Events\CambioPasswordEvent;
use azimbron15\Models\Usuario;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificarCambioPassword
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
     * @param  CambioPasswordEvent  $event
     * @return void
     */
    public function handle(CambioPasswordEvent $event)
    {
        $usuario = Usuario::find($event->usuarioActualizado->id)->toArray();
        $usuario['contrasenhaDes'] = $event->contrasenha;

        Mail::send('auth.emails.passwordReset', $usuario, function ($message) use ($usuario){

            $message->from('no-reply@angelzimbron15.esy.es', 'Cambio de contraseña');

            $message->to($usuario['email'])->subject('Cambio de contraseña de tu cuenta en sistema "Tu espacio Ángel Zimbrón"');

        });
    }
}
