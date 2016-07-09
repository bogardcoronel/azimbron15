<?php

namespace azimbron15\Listeners;

use azimbron15\Events\PagoAprobadoEvent;
use azimbron15\Models\PagoRealizado;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NotificarPagoAprobado
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
     * @param  PagoAprobadoEvent  $event
     * @return void
     */
    public function handle(PagoAprobadoEvent $event)
    {
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
        $pagoRealizado['correoDestino'] = DB::table('usuarios')->leftJoin('condominios', 'usuarios.condominio_id', '=', 'condominios.id')
            ->leftJoin('pagos_realizados', 'condominios.id', '=', 'pagos_realizados.condominio_id')
            ->where('pagos_realizados.id', '=', $event->pagoRealizado->id)->first()->email;

        Mail::send('emails.pagoRealizado', $pagoRealizado, function ($message) use ($pagoRealizado){

            $message->from('no-reply@angelzimbron15.esy.es', 'Pago realizado');

            $message->to($pagoRealizado['correoDestino'])->subject('Pago aprobado "Tu espacio Ángel Zimbrón".');

        });
    }
}
