<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'business_id'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }
}
