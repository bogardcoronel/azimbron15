<?php
/**
 * Created by IntelliJ IDEA.
 * User: Bogard
 * Date: 22/06/2016
 * Time: 11:14 AM
 */

namespace azimbron15\Listeners;

use azimbron15\Events\PagoRealizadoEvent;

class NotificarAdminPagoRealizado{
    /**
     * Handle the event.
     *
     * @param  PagoRealizado  $event
     * @return void
     */
    public function handle(PagoRealizadoEvent $event)
    {
        //Envio de email
    }
}