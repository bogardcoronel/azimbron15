<?php

namespace azimbron15\Events;

use azimbron15\Events\Event;
use azimbron15\Models\Usuario;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CambioPasswordEvent extends Event
{
    use SerializesModels;
    public $usuarioActualizado;
    public $contrasenha;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Usuario $usuarioActualizado, $contrasenha)
    {
        $this->usuarioActualizado = $usuarioActualizado;
        $this->contrasenha = $contrasenha;
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
