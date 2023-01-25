<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Http\Resources\EmpleadoResource;
use Opcodes\LogViewer\Facades\LogViewer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        EmpleadoResource::withoutWrapping();

        Model::shouldBeStrict();

        LogViewer::auth(function ($request) {
            return auth()->user()->hasRole('Administrador');
        });
    }
}
