<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssetCategory;
use App\Models\Business;
use App\Models\InventoryCategory;
use DataTables;

class AssetCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = AssetCategory::latest()->get();

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
                        // $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Show" class="show btn btn-primary btn-sm showAssetCategory">View</a>';

                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editAssetCategory">Edit</a>';

                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteAssetCategory">Delete</a>';

                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
        }

        $businesses = Business::all();

        return view('asset_category.index', compact('businesses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AssetCategory::updateOrCreate([
                    'id' => $request->asset_category_id
                ],
                [
                    'name' => $request->name,
                    'status' => $request->status == true ? 1 : 0,
                    'business_id'=> $request->business_id
                ]);

        return response()->json(['success'=>'AssetCategory saved successfully.']);
    }

    public function show($id)
    {
        $asset_category = AssetCategory::find($id);
        return view()->json($asset_category);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AssetCategory  $asset_category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $asset_category = AssetCategory::find($id);
        return response()->json($asset_category);

        // $businessUser = BusinessUser::with('business')->find($id);
        // return response()->json($businessUser);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AssetCategory  $asset_category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AssetCategory::find($id)->delete();

        return response()->json(['success'=>'AssetCategory deleted successfully.']);
    }
}
