<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Enrique',
            'ubicacion' => 'Catastro',
            'status' => 'activo',
            'email' => 'correo@correo.com',
            'password' => Hash::make('12345678'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Jesus Manriquez Vargas',
            'ubicacion' => 'Catastro',
            'status' => 'activo',
            'email' => 'jemava86@hotmail.com',
            'password' => Hash::make('12345678'),
        ])->assignRole('Administrador');
    }
}
