<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'head_id',
        'image',
        'caption',
    ];

    //ONE TO MANY INVERS
    public function headReport()
    {
        return $this->belongsTo(HeadReport::class, 'head_id');
    }
}
