<?php

use App\Http\Livewire\Admin\Roles;
use App\Http\Livewire\Admin\Horarios;
use App\Http\Livewire\Admin\Permisos;
use App\Http\Livewire\Admin\Personal;
use App\Http\Livewire\Admin\Usuarios;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Inhabiles;
use App\Http\Livewire\Admin\Inasistencias;
use App\Http\Livewire\Admin\Incapacidades;
use App\Http\Controllers\ChecadorController;
use App\Http\Livewire\Admin\Justificaciones;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Admin\Permisospersonal;
use App\Http\Controllers\Admin\PersonaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['middleware' => ['auth', 'esta.activo']], function(){

    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::get('usuarios', Usuarios::class)->name('usuarios');

    Route::get('permisos', Permisos::class)->name('permisos');

    Route::get('roles', Roles::class)->name('roles');

    Route::get('horarios', Horarios::class)->name('horarios');

    Route::get('inasistenciass', Inasistencias::class)->name('inasistencias');

    Route::get('permisos_personal', Permisospersonal::class)->name('permisos_personal');

    Route::get('incapacidadess', Incapacidades::class)->name('incapacidades');

    Route::get('personals', Personal::class)->name('personal');

    Route::get('personal_detalle/{persona}', PersonaController::class)->name('personal_detalle');

    Route::get('justificaciones', Justificaciones::class)->name('justificaciones');

    Route::get('inhabiles', Inhabiles::class)->name('inhabiles');

});

Route::get('checador', ChecadorController::class)->name('checador');

