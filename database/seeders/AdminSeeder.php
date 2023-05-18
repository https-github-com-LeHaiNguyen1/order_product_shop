<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'NguyenLeHai',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'author'
        ]);
    }
}
