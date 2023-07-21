<?php

use App\Http\Livewire\Admin\Roles;
use App\Http\Livewire\Admin\Horarios;
use App\Http\Livewire\Admin\Permisos;
use App\Http\Livewire\Admin\Personal;
use App\Http\Livewire\Admin\Reportes;
use App\Http\Livewire\Admin\Usuarios;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Auditoria;
use App\Http\Livewire\Admin\Inhabiles;
use App\Http\Controllers\ManualController;
use App\Http\Livewire\Admin\Incapacidades;
use App\Http\Controllers\ChecadorController;
use App\Http\Livewire\Admin\Justificaciones;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Admin\Permisospersonal;
use App\Http\Controllers\SetPasswordController;
use App\Http\Controllers\Admin\PersonaController;
use App\Http\Livewire\Admin\Formatos;

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

    Route::get('usuarios', Usuarios::class)->middleware('permission:Lista de usuarios')->name('usuarios');

    Route::get('permisos', Permisos::class)->middleware('permission:Lista de permisos')->name('permisos');

    Route::get('roles', Roles::class)->middleware('permission:Lista de roles')->name('roles');

    Route::get('horarios', Horarios::class)->middleware('permission:Lista de horarios')->name('horarios');

    Route::get('permisos_personal', Permisospersonal::class)->middleware('permission:Lista de permisos personal')->name('permisos_personal');

    Route::get('incapacidadess', Incapacidades::class)->middleware('permission:Lista de incapacidades')->name('incapacidades');

    Route::get('personals', Personal::class)->middleware('permission:Lista de personal')->name('personal');

    Route::get('personal_detalle/{persona}', PersonaController::class)->middleware('permission:Ver personal')->name('personal_detalle');

    Route::get('justificaciones', Justificaciones::class)->middleware('permission:Lista de justificaciones')->name('justificaciones');

    Route::get('inhabiles', Inhabiles::class)->middleware('permission:Lista de inhabiles')->name('inhabiles');

    Route::get('reportes', Reportes::class)->middleware('permission:Reportes')->name('reportes');

    Route::get('auditoria', Auditoria::class)->middleware('permission:Auditoria')->name('auditoria');

    Route::get('formatos', Formatos::class)->middleware('permission:Formatos')->name('formatos');

});

Route::get('checador', ChecadorController::class)->name('checador');

Route::get('setpassword/{email}', [SetPasswordController::class, 'create'])->name('setpassword');
Route::post('setpassword', [SetPasswordController::class, 'store'])->name('setpassword.store');

Route::get('manual', ManualController::class)->name('manual');

