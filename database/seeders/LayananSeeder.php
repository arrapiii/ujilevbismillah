<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('layanan_bks')->insert([
            'jenis_layanan' => 'bimbingan pribadi',

        ]);
        DB::table('layanan_bks')->insert([
            'jenis_layanan' => 'bimbingan sosial',

        ]);
        DB::table('layanan_bks')->insert([
            'jenis_layanan' => 'bimbingan karir',
        ]);
        DB::table('layanan_bks')->insert([
            'jenis_layanan' => 'bimbingan belajar',
        ]);
    }
}
