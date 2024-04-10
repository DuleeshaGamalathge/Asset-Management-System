<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssetHandling;
use App\Models\BusinessUser;
use App\Models\Business;
use DataTables;

class AssetHandlingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = AssetHandling::latest()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function ($item) {
                        if ($item->status == 0) {
                            return '<span class="badge badge-danger">Handovered</span>';
                        }

                        if ($item->status == 1) {
                            return '<span class="badge badge-success">In use</span>';
                        }
                    })
                    ->addColumn('action', function($row){
                        // $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Show" class="show btn btn-primary btn-sm showAssetHandling">View</a>';

                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editAssetHandling">Edit</a>';

                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteAssetHandling">Delete</a>';

                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
        }

        $businesses = Business::all();
        $business_users = BusinessUser::all();

        return view('asset_handling.index', compact('businesses','business_users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AssetHandling::updateOrCreate([
                    'id' => $request->asset_handling_id
                ],
                [
                    'business_user' => $request->business_user,
                    'created_by' => $request->created_by,
                    'given_date' => $request->given_date,
                    'given_by' => $request->given_by,
                    'handover_date' => $request->handover_date,
                    'handover_to' => $request->handover_to,
                    'status' => $request->status == true ? 1 : 0,
                    'business_id'=> $request->business_id
                ]);

        return response()->json(['success'=>'AssetHandling saved successfully.']);
    }

    public function show($id)
    {
        $asset_handling = AssetHandling::find($id);
        return view()->json($asset_handling);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AssetHandling  $asset_handling
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asset_handling = AssetHandling::find($id);
        return response()->json($asset_handling);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AssetHandling  $asset_handling
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AssetHandling::find($id)->delete();

        return response()->json(['success'=>'AssetHandling deleted successfully.']);
    }
}
