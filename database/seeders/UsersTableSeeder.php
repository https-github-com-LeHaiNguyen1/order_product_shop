<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Nguyễn Lê Hải',
            'email' => 'hai_admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // Insert roles
        DB::table('roles')->insert([
            'name' => 'admin',
        ]);

        // Insert permissions
        DB::table('permissions')->insert([
            'name' => 'manage_products',
            'description' => 'Manage products',
        ]);

        // Assign roles to users
        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);

        // Assign permissions to roles
        DB::table('permission_role')->insert([
            'permission_id' => 1,
            'role_id' => 1,
        ]);
    }
}
