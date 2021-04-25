<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Stock;

class StocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stock::factory(250)->create();

        DB::table('stocks')->insert([
            'nama_barang' => 'STALO',
            'group' => 'Receiver',
            'part_number' => 'RA01',
            'ref_des' => '1A10',
            'tgl_masuk' => '2021-03-01',
            'expired' => '2021-03-01',
            'kurs_beli' => 1500000000.11,
            'jumlah_unit' => 2,
            'status' => 'Obsolete',
            'keterangan' => '1 di EEC, 2 di BMKG',
            'created_at'=>now()
        ]);
        DB::table('stocks')->insert([
            'nama_barang' => 'Moxa',
            'group' => 'Transmitter',
            'part_number' => 'Mo01',
            'ref_des' => '2B10',
            'tgl_masuk' => '2021-03-01',
            'expired' => '2021-03-01',
            'kurs_beli' =>  5376900.11,
            'jumlah_unit' => 2,
            'status' => 'Obsolete',
            'keterangan' => '1 di EEC, 2 di BMKG',
            'created_at'=>now()
        ]);
        DB::table('stocks')->insert([
            
            'nama_barang' => 'Waveguide',
            'group' => 'Antenna',
            'part_number' => 'WA01',
            'ref_des' => 'WA0102',
            'tgl_masuk' => '2021-03-01',
            'expired' => '2021-03-01',
            'kurs_beli' =>  21801000.81,
            'jumlah_unit' => 2,
            'status' => 'Not Obsolete',
            'keterangan' => '1 di EEC, 2 di BMKG',
            'created_at'=>now()
        ]);
    }
}
