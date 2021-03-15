<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintedReport extends Model
{
    use HasFactory;

    protected $primaryKey = 'printed_report_id';

    protected $fillable = [
        'head_id',
        'file',
    ];
}
