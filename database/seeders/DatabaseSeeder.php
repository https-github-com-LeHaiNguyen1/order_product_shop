<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* `->call(AdminSeeder::class);` is calling the `run()` method of the `AdminSeeder` class,
        which is responsible for seeding the database with initial data for the admin user. This is
        done as part of the overall database seeding process in Laravel. */
        $this->call(AdminSeeder::class);
    }
}
