<?php

namespace NotificationChannels\Flowroute;

use Illuminate\Support\ServiceProvider;

class FlowrouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(FlowrouteChannel::class)
            ->needs(Flowroute::class)
            ->give(function () {
                return new Flowroute(config('services.flowroute'));
            });

    }
}
