<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssetCategory;
use App\Models\Business;
use App\Models\AssetSubCategory;
use DataTables;

class AssetSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $business_id = session()->get('business_id');
        $query = AssetSubCategory::where('business_id',$business_id);

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
                        // $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Show" class="show btn btn-primary btn-sm showAssetSubCategory">View</a>';

                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editAssetSubCategory">Edit</a>';

                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteAssetSubCategory">Delete</a>';

                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
        }

        $businesses = Business::all();
        $asset_categories = AssetCategory::all();

        return view('asset_sub_category.index', compact('businesses', 'asset_categories'));
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

        AssetSubCategory::updateOrCreate([
                    'id' => $request->asset_sub_category_id
                ],
                [
                    'name' => $request->name,
                    'asset_category_id' => $request->asset_category_id,
                    'status' => $request->status == true ? 1 : 0,
                    'business_id'=> $business_id
                ]);

        return response()->json(['success'=>'AssetSubCategory saved successfully.']);
    }

    public function show($id)
    {
        $asset_sub_category = AssetSubCategory::find($id);
        return view()->json($asset_sub_category);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AssetSubCategory  $asset_sub_category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asset_sub_category = AssetSubCategory::find($id);
        return response()->json($asset_sub_category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AssetSubCategory  $asset_sub_category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AssetSubCategory::find($id)->delete();

        return response()->json(['success'=>'AssetSubCategory deleted successfully.']);
    }
}
