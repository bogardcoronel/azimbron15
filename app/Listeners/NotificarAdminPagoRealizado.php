<?php
/**
 * Created by IntelliJ IDEA.
 * User: Bogard
 * Date: 22/06/2016
 * Time: 11:14 AM
 */

namespace azimbron15\Listeners;

use azimbron15\Events\PagoRealizadoEvent;
use azimbron15\Models\PagoRealizado;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        $tablePagos = "<table class='table'><thead><th>Concepto</th><th>Cantidad pagada</th></thead>";
        $pagosRealizados = PagoRealizado::find($event->pagoRealizado->id);
        foreach ($pagosRealizados->pagosConceptos as $pagoConcepto){
            $tablePagos .="<tbody>";
            $tablePagos .="<td>$pagoConcepto->concepto</td><td>$pagoConcepto->cantidad</td>";
            $tablePagos .="</tbody>";
        }
        $tablePagos .= "</table>";
        $pagoRealizado = PagoRealizado::find($event->pagoRealizado->id)->toArray();
        $pagoRealizado['pagos'] = $tablePagos;
        $pagoRealizado['realPath'] = $event->realPath;
        $pagoRealizado['mimeType'] = $event->mimeType;
        $pagoRealizado['nombreArchivo'] = $event->nombreArchivo;
        $pagoRealizado['deptoPaga'] = $event->pagoRealizado->condominio->departamento;
        $pagoRealizado['correoAdmin'] = DB::table('usuarios')->leftJoin('usuarios_roles', 'usuarios.id', '=', 'usuarios_roles.usuario_id')
            ->where('usuarios_roles.role_id', '=', 1)->first()->email;

        Mail::send('emails.pagoRealizado', $pagoRealizado, function ($message) use ($pagoRealizado){

            $message->from('no-reply@angelzimbron15.esy.es', 'Pago realizado');

            $message->to($pagoRealizado['correoAdmin'])->subject('Pago realizado por el departamento '. $pagoRealizado['deptoPaga'].'.');

            $message->attach($pagoRealizado['realPath'], ['as' => $pagoRealizado['nombreArchivo'], 'mime' => $pagoRealizado['mimeType']]);

        });
    }
}