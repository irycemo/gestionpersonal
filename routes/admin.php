<?php
use App\Http\Livewire\Admin\Usuarios;
use Illuminate\Support\Facades\Route;


Route::get('usuarios', Usuarios::class)->name('usuarios');
