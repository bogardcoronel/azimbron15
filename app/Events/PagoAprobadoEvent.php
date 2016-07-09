<?php

namespace azimbron15\Events;

use azimbron15\Events\Event;
use azimbron15\Models\PagoRealizado;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PagoAprobadoEvent extends Event
{
    use SerializesModels;
    public $pagoRealizado;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PagoRealizado $pagoRealizado)
    {
        $this->pagoRealizado = $pagoRealizado;
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
