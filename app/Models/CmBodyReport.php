<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmBodyReport extends Model
{
    use HasFactory;

    protected $primaryKey = 'cm_id';

    protected $fillable = [
        'head_id',
        'remark',
    ];
}
