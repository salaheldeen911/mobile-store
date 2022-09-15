<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('role_has_permissions')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Roles
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $userRole = Role::create(['name' => 'user', 'guard_name' => 'web']);

        // permissions
        $addProductPermission = Permission::create(['name' => 'add product', 'guard_name' => 'web']);
        $deleteProductPermission = Permission::create(['name' => 'delete product', 'guard_name' => 'web']);
        $editProductPermission = Permission::create(['name' => 'edit product', 'guard_name' => 'web']);

        // Assign all permissions to the role admin
        $adminRole->syncPermissions([$addProductPermission, $deleteProductPermission, $editProductPermission]);
    }
}
