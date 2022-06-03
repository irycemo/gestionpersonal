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
            'name' => 'Admin',
            'ubicacion' => 'catastro',
            'status' => 'activo',
            'email' => 'correo@correo.com',
            'password' => Hash::make('12345678'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Liz',
            'email' => 'correo2@correo.com',
            'ubicacion' => Arr::random(['catastro', 'rpp']),
            'status' => 'activo',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->assignRole('Delegado(a) Administrativo(a)');

        User::create([
            'name' => 'Alejandro',
            'email' => 'correo3@correo.com',
            'ubicacion' => Arr::random(['catastro', 'rpp']),
            'status' => 'activo',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->assignRole('Jefe(a) de Departamento');


        User::create([
            'name' => 'Martin',
            'email' => 'correo4@correo.com',
            'ubicacion' => Arr::random(['catastro', 'rpp']),
            'status' => 'activo',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->assignRole('Jefe(a) de Departamento');

        User::create([
            'name' => 'Ana',
            'email' => 'correo5@correo.com',
            'ubicacion' => Arr::random(['catastro', 'rpp']),
            'status' => 'activo',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->assignRole('Contador(a)');

        User::create([
            'name' => 'Carlos',
            'email' => 'correo6@correo.com',
            'ubicacion' => Arr::random(['catastro', 'rpp']),
            'status' => 'activo',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->assignRole('Almacenista');

        User::create([
            'name' => 'Francisco',
            'email' => 'correo7@correo.com',
            'ubicacion' => Arr::random(['catastro', 'rpp']),
            'status' => 'activo',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->assignRole('Almacenista');

        User::create([
            'name' => 'Jorge',
            'email' => 'correo8@correo.com',
            'ubicacion' => Arr::random(['catastro', 'rpp']),
            'status' => 'activo',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->assignRole('Almacenista');

        User::create([
            'name' => 'Claudia',
            'email' => 'correo9@correo.com',
            'ubicacion' => Arr::random(['catastro', 'rpp']),
            'status' => 'activo',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->assignRole('Almacenista');

        User::create([
            'name' => 'Maria',
            'email' => 'correo10@correo.com',
            'ubicacion' => Arr::random(['catastro', 'rpp']),
            'status' => 'activo',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->assignRole('Almacenista');

        User::create([
            'name' => 'Juan',
            'email' => 'correo11@correo.com',
            'ubicacion' => Arr::random(['catastro', 'rpp']),
            'status' => 'activo',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->assignRole('Almacenista');
    }
}
