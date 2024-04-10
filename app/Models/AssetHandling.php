<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetHandling extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_user',
        'created_by',
        'given_date',
        'given_by',
        'handover_date',
        'handover_to',
        'status', // 0 = Inactive, 1 = Active
        'business_id',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function users()
    {
        return $this->belongsToMany(BusinessUser::class);
    }
}
