<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'stocks';

    protected $primaryKey = 'stock_id';

    protected $fillable = [
        'nama_barang',
        'group',
        'part_number',
        'ref_des',
        'tgl_masuk',
        'expired',
        'kurs_beli',
        'jumlah_unit',
        'status',
        'keterangan'
    ];

    protected $guarded = [
        'stock_id'
    ];

    // protected $attributes = [
    //     'status' => 0 //not obsolete
    // ];
}
