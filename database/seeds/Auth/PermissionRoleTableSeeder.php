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
        $admin = Role::create(['name' => config('access.users.admin_role')]);
        $executive = Role::create(['name' => 'executive']);
        $supply_officer = Role::create(['name' => 'supply officer']);
        $user = Role::create(['name' => config('access.users.default_role')]);

        // Create Permissions
        Permission::create(['name' => 'view backend']);
        // Create Permissions - View, Manage - Inventory
        Permission::create(['name' => 'view inventory']);
        Permission::create(['name' => 'create inventory']);
        Permission::create(['name' => 'edit inventory']);
        Permission::create(['name' => 'delete inventory']);
        Permission::create(['name' => 'force delete inventory']);
        Permission::create(['name' => 'restore inventory']);
        // Create Permissions - View, Manage - Distributor
        Permission::create(['name' => 'view distributor']);
        Permission::create(['name' => 'create distributor']);
        Permission::create(['name' => 'edit distributor']);
        Permission::create(['name' => 'delete distributor']);
        Permission::create(['name' => 'force delete distributor']);
        Permission::create(['name' => 'restore distributor']);
        // Create Permissions - View, Manage - Client
        Permission::create(['name' => 'view client']);
        Permission::create(['name' => 'create client']);
        Permission::create(['name' => 'edit client']);
        Permission::create(['name' => 'delete client']);
        Permission::create(['name' => 'force delete client']);
        Permission::create(['name' => 'restore client']);

        // ALWAYS GIVE ADMIN ROLE ALL PERMISSIONS
        $admin->givePermissionTo('view backend');
        $admin->givePermissionTo('view inventory');
        $admin->givePermissionTo('create inventory');
        $admin->givePermissionTo('edit inventory');
        $admin->givePermissionTo('delete inventory');
        $admin->givePermissionTo('force delete inventory');
        $admin->givePermissionTo('restore inventory');
        // ADMIN HAS ALL THE PERMISSIONS FOR MANAGING DISTRIBUTORS
        $admin->givePermissionTo('view distributor');
        $admin->givePermissionTo('create distributor');
        $admin->givePermissionTo('edit distributor');
        $admin->givePermissionTo('delete distributor');
        $admin->givePermissionTo('force delete distributor');
        $admin->givePermissionTo('restore distributor');
        // ADMIN HAS ALL THE PERMISSIONS FOR MANAGING CLIENTS
        $admin->givePermissionTo('view client');
        $admin->givePermissionTo('create client');
        $admin->givePermissionTo('edit client');
        $admin->givePermissionTo('delete client');
        $admin->givePermissionTo('force delete client');
        $admin->givePermissionTo('restore client');

        // Assign Permissions to other Roles
        $executive->givePermissionTo('view backend');

        // Assign Permissions to supply officer
        $supply_officer->givePermissionTo('view backend');
        $supply_officer->givePermissionTo('view inventory');
        $supply_officer->givePermissionTo('create inventory');
        $supply_officer->givePermissionTo('edit inventory');
        $supply_officer->givePermissionTo('delete inventory');
        $supply_officer->givePermissionTo('restore inventory');
        // Granted Distributor Permissions to Supply Officer
        $supply_officer->givePermissionTo('view distributor');
        $supply_officer->givePermissionTo('create distributor');
        $supply_officer->givePermissionTo('edit distributor');
        $supply_officer->givePermissionTo('delete distributor');
        $supply_officer->givePermissionTo('restore distributor');
        // Granted Distributor Permissions to Supply Officer
        $supply_officer->givePermissionTo('view client');
        $supply_officer->givePermissionTo('create client');
        $supply_officer->givePermissionTo('edit client');
        $supply_officer->givePermissionTo('delete client');
        $supply_officer->givePermissionTo('restore client');

        $this->enableForeignKeys();
    }
}
