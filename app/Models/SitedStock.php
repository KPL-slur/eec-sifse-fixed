<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitedStock extends Model
{
    use HasFactory;
    protected $table = 'sited_stocks';
    
    protected $primaryKey = 'sited_stock_id';

    protected $fillable = [
        'stock_id',
        'site_id',
    ];
}
