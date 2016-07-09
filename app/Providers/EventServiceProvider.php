<?php

namespace azimbron15\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'azimbron15\Events\PagoRealizadoEvent' => [
            'azimbron15\Listeners\NotificarAdminPagoRealizado',
        ],
        'azimbron15\Events\UsuarioCreadoEvent' => [
            'azimbron15\Listeners\NotificarUsuarioCreado',
        ],
        'azimbron15\Events\PagoAprobadoEvent' => [
            'azimbron15\Listeners\NotificarPagoAprobado',
        ],
        'azimbron15\Events\CambioPasswordEvent' => [
            'azimbron15\Listeners\NotificarCambioPassword',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
