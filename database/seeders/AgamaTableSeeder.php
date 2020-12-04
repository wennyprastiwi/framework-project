<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agama;

class AgamaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agama1 = new Agama;
        $agama1->nama = "Islam";
        $agama1->save();

        $agama2 = new Agama;
        $agama2->nama = "Protestan";
        $agama2->save();

        $agama3 = new Agama;
        $agama3->nama = "Katolik";
        $agama3->save();

        $agama4 = new Agama;
        $agama4->nama = "Hindu";
        $agama4->save();

        $agama5 = new Agama;
        $agama5->nama = "Buddha";
        $agama5->save();

        $agama6 = new Agama;
        $agama6->nama = "Konghucu";
        $agama6->save();
    }
}
