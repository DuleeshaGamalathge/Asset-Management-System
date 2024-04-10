<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'asset_category_id',
        'status', // 0 = Inactive, 1 = Active
        'business_id',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function assetCategory()
    {
        return $this->hasMany(AssetCategory::class);
    }
}
