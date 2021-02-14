<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stocks')->insert([
            'site_id' => '2',
            'nama_barang' => 'STALO',
            'group' => '2',
            'part_number' => 'RA01',
            'serial_number' => 'RA0102',
            'tgl_masuk' => now(),
            'expired' => now(),
            'kurs_beli' => 1500000000,
            'jumlah_unit' => 2,
            'status' => 1
        ]);
        DB::table('stocks')->insert([
            'site_id' => '2',
            'nama_barang' => 'Moxa',
            'group' => '1',
            'part_number' => 'Mo01',
            'serial_number' => 'Mo0102',
            'tgl_masuk' => now(),
            'expired' => now(),
            'kurs_beli' =>  5376900,
            'jumlah_unit' => 2,
            'status' => 1
        ]);
        DB::table('stocks')->insert([
            'site_id' => '2',
            'nama_barang' => 'Waveguide',
            'group' => '3',
            'part_number' => 'WA01',
            'serial_number' => 'WA0102',
            'tgl_masuk' => now(),
            'expired' => now(),
            'kurs_beli' =>  21801000,
            'jumlah_unit' => 2,
            'status' => 1
        ]);
    }
}
