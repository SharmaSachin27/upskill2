<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        //
        $roleSuperAdmin = Role::create(['name' => 'super-admin']);
        $roleCompanyAdmin = Role::create(['name' => 'company-admin']);
    }
}
