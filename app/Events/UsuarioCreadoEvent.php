<?php

namespace azimbron15\Events;

use azimbron15\Events\Event;
use azimbron15\Models\Usuario;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UsuarioCreadoEvent extends Event
{
    use SerializesModels;
    public $usuarioCreado;
    public $contrasenha;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Usuario $usuarioCreado, $contrasenha)
    {
        $this->usuarioCreado = $usuarioCreado;
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
