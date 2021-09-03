<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create product']);
        Permission::create(['name' => 'read product']);
        Permission::create(['name' => 'edit product']);
        Permission::create(['name' => 'delete product']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'user']);
        $role1->givePermissionTo('read product');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('create product');
        $role2->givePermissionTo('read product');
        $role2->givePermissionTo('edit product');
        $role2->givePermissionTo('delete product');

        $role3 = Role::create(['name' => 'superadmin']);
        $role3->givePermissionTo('create product');
        $role3->givePermissionTo('read product');
        $role3->givePermissionTo('edit product');
        $role3->givePermissionTo('delete product');

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'email' => 'test@example.com',
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Admin User',
            'email' => 'admin@example.com',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Super-Admin User',
            'email' => 'superadmin@example.com',
        ]);
        $user->assignRole($role3);
    }
}
