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
        $this->call([
            InstansiSeeder::class,
            RolesAndPermissionsSeeder::class,
            UsersSeeder::class,
            TopicSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            IdentitySeeder::class,
            IKMSeeder::class,
        ]);
    }
}
