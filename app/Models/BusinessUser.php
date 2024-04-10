<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessUser extends Model
{
    use HasFactory;

    protected $table="business_user";

    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'business_user_email',
        'contact',
        'status', // 0 = Inactive, 1 = Active
        'business_id',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }

    public function assetHandling()
    {
        return $this->belongsToMany(AssetHandling::class);
    }
}

