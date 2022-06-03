<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\HorarioSeeder;
use Database\Seeders\InhabilSeeder;
use Database\Seeders\PermisoSeeder;
use Database\Seeders\PersonaSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        /* $this->call(HorarioSeeder::class); */
        $this->call(InhabilSeeder::class);
        $this->call(PermisoSeeder::class);
        $this->call(PersonaSeeder::class);

    }
}
