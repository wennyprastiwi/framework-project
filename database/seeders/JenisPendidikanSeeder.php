<?php

namespace Database\Seeders;

use App\Models\JenisPendidikan;
use Illuminate\Database\Seeder;

class JenisPendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenisPendidikan1 = new JenisPendidikan;
        $jenisPendidikan1->nama_jenis_pendidikan = "SMA / SMK";
        $jenisPendidikan1->save();

        $jenisPendidikan2 = new JenisPendidikan;
        $jenisPendidikan2->nama_jenis_pendidikan = "D1";
        $jenisPendidikan2->save();

        $jenisPendidikan3 = new JenisPendidikan;
        $jenisPendidikan3->nama_jenis_pendidikan = "D3";
        $jenisPendidikan3->save();

        $jenisPendidikan4 = new JenisPendidikan;
        $jenisPendidikan4->nama_jenis_pendidikan = "D4";
        $jenisPendidikan4->save();

        $jenisPendidikan5 = new JenisPendidikan;
        $jenisPendidikan5->nama_jenis_pendidikan = "S1";
        $jenisPendidikan5->save();

        $jenisPendidikan6 = new JenisPendidikan;
        $jenisPendidikan6->nama_jenis_pendidikan = "S2";
        $jenisPendidikan6->save();
    }
}
