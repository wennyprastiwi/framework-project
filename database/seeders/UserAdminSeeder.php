<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
        $admin->username = "admin";
        $admin->email_user = "admin@mail.com";
        $admin->password = Hash::make('admin12345');
        $admin->type = 99;
        $admin->email_verified_at = date('Y-m-d H:i:s');
        $admin->save();
    }
}
