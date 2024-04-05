<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'business_email',
        'street_no',
        'address',
        'city',
        'status', // 0 = Inactive, 1 = Active
    ];

    public function users()
    {
        return $this->hasMany(BusinessUser::class);
    }

    public function invectoryCategories()
    {
        return $this->hasMany(InventoryCategory::class);
    }

}
