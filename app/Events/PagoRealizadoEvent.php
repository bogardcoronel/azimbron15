<?php

namespace azimbron15\Events;

use azimbron15\Events\Event;
use azimbron15\Models\PagoRealizado;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PagoRealizadoEvent extends Event
{
    use SerializesModels;

    public $pagoRealizado;
    public $realPath;
    public $mimeType;
    public  $nombreArchivo;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PagoRealizado $pagoRealizado, $realPath, $mimeType, $nombreArchivo)
    {
        $this->pagoRealizado = $pagoRealizado;
        $this->realPath = $realPath;
        $this->mimeType = $mimeType;
        $this->nombreArchivo = $nombreArchivo;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
