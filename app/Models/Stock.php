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
        'site_id',
        'nama_barang',
        'group',
        'part_number',
        'serial_number',
        'tgl_masuk',
        'expired',
        'kurs_beli',
        'jumlah_unit',
        'status'
    ];

    protected $guarded = [
        'stock_id'
    ];

    protected $attributes = [
        'status' => 0
    ];
}
