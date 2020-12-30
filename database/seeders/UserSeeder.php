<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'email_user' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'type' => 99,
        ]);

        $faker = Faker::create('id_ID');

    	for($i = 1; $i <= 10; $i++){

    		DB::table('users')->insert([
    			'username' => Str::random(5),
                'email_user' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => Hash::make(Str::random(5)),
                'type' => $faker->numberBetween(1,2),
    		]);

    	}


    }
}
