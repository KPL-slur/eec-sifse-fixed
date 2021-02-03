<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    protected $table = 'distributions';
    protected $fillable = [
        'name',
        'lokasi',
    ];
    use HasFactory;
}
