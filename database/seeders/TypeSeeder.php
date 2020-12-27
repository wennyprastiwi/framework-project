<?php

namespace Database\Seeders;
use App\Models\Type;

use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type1 = new Type;
        $type1->nama_type = "Admin";
        $type1->save();

        $type2 = new Type;
        $type2->nama_type = "Pencari Kerja";
        $type2->save();

        $type3 = new Type;
        $type3->nama_type = "Penyedia Kerja";
        $type3->save();
    }
}
