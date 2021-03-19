<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeadReport extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'head_id';

    protected $guarded = [
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
        return $this->belongsToMany(Expert::class, 'expert_reports', 'head_id', 'expert_id')->withPivot('expert_report_id', 'role');;
    }

    //ONE TO ONE
    public function pmBodyReport()
    {
        return $this->hasOne(PmBodyReport::class, 'head_id');
    }

    public function cmBodyReport()
    {
        return $this->hasOne(CmBodyReport::class, 'head_id');
    }

    public function printedReports()
    {
        return $this->hasOne(PrintedReport::class, 'head_id');
    }

    //ONE TO MANY
    public function recommendations()
    {
        return $this->hasMany(Recommendation::class, 'head_id');
    }

    public function reportImages()
    {
        return $this->hasMany(ReportImage::class, 'head_id');
    }
}
