<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleTableSeeder extends Seeder
{

    use DisableForeignKeys;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Create Roles
        $admin = Role::create(['name' => 'administrator', 'guard_name' => 'backpack']);
        $student = Role::create(['name' => 'student', 'guard_name' => 'backpack']);

        // Create Permissions
        $permissions = ['manage user', 'manage students', 'manage reports'];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'backpack']);
        }

        // ALWAYS GIVE ADMIN ROLE ALL PERMISSIONS
        $admin->givePermissionTo(Permission::all());
 

        $this->enableForeignKeys();
    }
}
