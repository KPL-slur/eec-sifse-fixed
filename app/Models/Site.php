<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'sites';

    protected $primaryKey = 'site_id';

    protected $fillable = [
        'site',
        'lokasi',
        'image',
    ];
    use HasFactory;

    //ONE TO MANY
    public function headReports()
    {
        return $this->hasMany(HeadReport::class, 'site_id');
    }
}
