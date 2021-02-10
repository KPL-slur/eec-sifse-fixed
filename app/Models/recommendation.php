<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'head_id',
        'spare_part_name',
        'qty',
    ];
}
