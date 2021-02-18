<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadReport extends Model
{
    use HasFactory;

    protected $primaryKey = 'head_id';

    protected $guarded = [
        'id',
        'created_at',
        'deleted_at',
    ];
}