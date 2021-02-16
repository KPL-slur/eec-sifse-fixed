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

    //ONE TO MANY INVERS
    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }

    //MANY TO MANY
    public function experts()
    {
        return $this->belongsToMany(Expert::class, 'expert_reports', 'head_id', 'expert_id');
    }
}
