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
        $this->call(AgamaTableSeeder::class);

        $this->call(JenisPendidikanSeeder::class);

        $this->call(UserSeeder::class);
    }
}
