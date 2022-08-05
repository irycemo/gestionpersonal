<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Delegado(a) Administrativo(a)']);
        $role3 = Role::create(['name' => 'Contador(a)']);
        $role4 = Role::create(['name' => 'Checador']);

        Permission::create(['name' => 'Lista de roles', 'area' => 'Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'Crear rol', 'area' => 'Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'Editar rol', 'area' => 'Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'Borrar rol', 'area' => 'Roles'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de permisos', 'area' => 'Permisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'Crear permiso', 'area' => 'Permisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'Editar permiso', 'area' => 'Permisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'Borrar permiso', 'area' => 'Permisos'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de usuarios', 'area' => 'Usuarios'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Crear usuario', 'area' => 'Usuarios'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Editar usuario', 'area' => 'Usuarios'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Borrar usuario', 'area' => 'Usuarios'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de horarios', 'area' => 'Horarios'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Crear horario', 'area' => 'Horarios'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Editar horario', 'area' => 'Horarios'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Borrar horario', 'area' => 'Horarios'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de permisos personal', 'area' => 'Permisos Personal'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Crear permiso personal', 'area' => 'Permisos Personal'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Editar permiso personal', 'area' => 'Permisos Personal'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Borrar permiso personal', 'area' => 'Permisos Personal'])->syncRoles([$role1]);
        Permission::create(['name' => 'Asignar permiso personal', 'area' => 'Permisos Personal'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de incapacidades', 'area' => 'Incapacidades'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Crear incapacidad', 'area' => 'Incapacidades'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Editar incapacidad', 'area' => 'Incapacidades'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Borrar incapacidad', 'area' => 'Incapacidades'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de personal', 'area' => 'Personal'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Crear personal', 'area' => 'Personal'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Editar personal', 'area' => 'Personal'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Borrar personal', 'area' => 'Personal'])->syncRoles([$role1]);
        Permission::create(['name' => 'Ver personal', 'area' => 'Personal'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de justificaciones', 'area' => 'Justificación'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Crear justificacion', 'area' => 'Justificación'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Editar justificacion', 'area' => 'Justificación'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Borrar justificacion', 'area' => 'Justificación'])->syncRoles([$role1]);
        Permission::create(['name' => 'Ver justificacion', 'area' => 'Justificación'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de inhabiles', 'area' => 'Inhábiles'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Crear inhabil', 'area' => 'Inhábiles'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Editar inhabil', 'area' => 'Inhábiles'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Borrar inhabil', 'area' => 'Inhábiles'])->syncRoles([$role1]);
        Permission::create(['name' => 'Ver inhabil', 'area' => 'Inhábiles'])->syncRoles([$role1]);

        Permission::create(['name' => 'Reportes', 'area' => 'Reportes'])->syncRoles([$role1]);

        Permission::create(['name' => 'Checador', 'area' => 'Checador'])->syncRoles([$role1,$role4]);

    }

}
