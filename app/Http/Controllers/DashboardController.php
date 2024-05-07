<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryCategory;


class DashboardController extends Controller
{

    public function index()
    {
        $inventory_categories = InventoryCategory::all(); // Retrieve all categories
        return view('layouts.dashboard', compact('inventory_categories'));
    }
     public function home(){
        return view ('layouts.home');
     }
}
