<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'sites';

    protected $primaryKey = 'site_id';

    protected $fillable = [
        'radar_name',
        'station_id',
        'image',
    ];
    use HasFactory;

    //ONE TO MANY
    public function headReports()
    {
        return $this->hasMany(HeadReport::class, 'site_id');
    }

    public function distributions()
    {
        return $this->hasMany(Distribution::class, 'site_id');
    }

    public function sitedStocks()
    {
        return $this->hasMany(SitedStock::class, 'site_id');
    }

    //MANY TO MANY
    public function stocks()
    {
        return $this->belongsToMany(Stock::class, 'sited_stocks', 'site_id', 'stock_id');
    }
}
