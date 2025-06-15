<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kabupatenList = ['Merauke', 'Asmat', 'Mappi', 'Boven Digoel'];

        foreach ($kabupatenList as $nama) {
            DB::table('kabupaten')->updateOrInsert(['kabupaten' => $nama]);
        }
    }
}