<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertReport extends Model
{
    use HasFactory;

    protected $primaryKey = 'expert_report_id';

    protected $fillable = [
        'head_id',
        'expert_id',
    ];
}
