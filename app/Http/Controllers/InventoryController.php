<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\BusinessUser;
use App\Models\InventoryCategory;
use App\Models\Inventory;
use DataTables;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $business_id = session()->get('business_id');
        $query = Inventory::where('business_id',$business_id);

        // $inventories = Inventory::where('inventory_category_id', $inventory_category_id)
        // ->where('business_id', $business_id)
        // ->get();

        if ($request->ajax()) {
            // $inventory_category_id = $request->input('inventory_category_id');

            // $data = $query->where('inventory_category_id', $inventory_category_id)
            //             ->latest()
            //             ->get();

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
                        // $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Show" class="show btn btn-primary btn-sm showInventory">View</a>';

                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editInventory">Edit</a>';

                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteInventory">Delete</a>';

                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
        }

        $businesses = Business::all();
        $inventory_categories = InventoryCategory::all();
        $business_users = BusinessUser::all();
        return view('inventory.index', compact('businesses', 'inventory_categories', 'business_users'));
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

        Inventory::updateOrCreate([
                    'id' => $request->inventory_id
                ],
                [
                    'inventory_no' => $request->inventory_no,
                    'name' => $request->name,
                    'inventory_category_id' => $request->inventory_category_id,
                    'purchased_date' => $request->purchased_date,
                    'warranty' => $request->warranty,
                    'description' => $request->description,
                    'remarks' => $request->remarks,
                    'status' => $request->status == true ? 1 : 0,
                    'created_by' => $request->created_by,
                    'updated_by' => $request->updated_by,
                    'business_id'=> $business_id
                ]);

        return response()->json(['success'=>'Inventory saved successfully.']);
    }

    public function show($id)
    {
        $inventory = Inventory::find($id);
        return view()->json($inventory);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventory = Inventory::find($id);
        return response()->json($inventory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Inventory::find($id)->delete();

        return response()->json(['success'=>'Inventory deleted successfully.']);
    }
}
