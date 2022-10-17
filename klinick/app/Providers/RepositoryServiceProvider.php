<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\DoctorRepository::class, \App\Repositories\DoctorRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AppointmentRepository::class, \App\Repositories\AppointmentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MedFormRepository::class, \App\Repositories\MedFormRepositoryEloquent::class);
        //:end-bindings:
    }
}
