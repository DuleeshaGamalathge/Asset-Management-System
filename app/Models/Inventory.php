<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_no',
        'name',
        'inventory_category_id',
        'purchased_date',
        'warranty',
        'description',
        'remarks',
        'status',
        'created_by',
        'updated_by',
        'business_id'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function inventoryCategory()
    {
        return $this->belongsTo(InventoryCategory::class);
    }

    public function users()
    {
        return $this->belongsToMany(BusinessUser::class);
    }
}
