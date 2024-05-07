<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryCategory;
use App\Models\Inventory;
use App\Models\Business;
use DataTables;

class InventoryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $business_id = session()->get('business_id');
        $query = InventoryCategory::where('business_id',$business_id);

        if ($request->ajax()) {

            $data = $query->latest()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function ($item) {
                        if ($item->status == 0) {
                            return '<span class="badge badge-danger">Inactive</span>';
                        }

                        if ($item->status == 1) {
                            return '<span class="badge badge-success">Active</span>';
                        }
                    })
                    ->addColumn('action', function($row){
                        // $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Show" class="show btn btn-primary btn-sm showInventoryCategory">View</a>';

                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editInventoryCategory">Edit</a>';

                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteInventoryCategory">Delete</a>';

                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
        }

        $businesses = Business::all();

        return view('inventory_category.index', compact('businesses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $business_id = session()->get('business_id');

        InventoryCategory::updateOrCreate([
                    'id' => $request->inventory_category_id
                ],
                [
                    'name' => $request->name,
                    'status' => $request->status == true ? 1 : 0,
                    'business_id'=> $business_id
                ]);

        return response()->json(['success'=>'InventoryCategory saved successfully.']);
    }

    public function show($id)
    {
        $inventory_category = InventoryCategory::find($id);
        return view()->json($inventory_category);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InventoryCategory  $inventory_category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $inventory_category = InventoryCategory::find($id);
        return response()->json($inventory_category);

        // $businessUser = BusinessUser::with('business')->find($id);
        // return response()->json($businessUser);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InventoryCategory  $inventory_category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InventoryCategory::find($id)->delete();

        return response()->json(['success'=>'InventoryCategory deleted successfully.']);
    }

    public function move_to_dashboard($inventory_category_id) {
        // Retrieve inventories belonging to the specified category
        $inventories = Inventory::where('inventory_category_id', $inventory_category_id)->get();

        // Return the inventories as JSON response
        return response()->json($inventories);
    }

}
