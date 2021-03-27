<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;

    protected $primaryKey = 'expert_id';

    protected $fillable = [
        'name',
        'nip',
        'expert_company',
    ];

    /**
     * 
     */
    public function user()
    {
        return $this->hasOne(User::class, 'expert_id');
    }
}
