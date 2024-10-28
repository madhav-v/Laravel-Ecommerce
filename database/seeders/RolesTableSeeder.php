<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()

            // Role::truncate(); // Caution: This will delete all existing roles
{

    Role::create(['name' => 'admin']);
    Role::create(['name' => 'user']);
}

}

