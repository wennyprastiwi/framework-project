<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutUs;

class AboutSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $about = new AboutUs;
        $about->sejarah = " ";
        $about->visi = " ";
        $about->misi = " ";
        $about->kontak = " ";
        $about->save();
    }
}
