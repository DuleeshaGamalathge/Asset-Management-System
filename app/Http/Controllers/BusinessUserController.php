<?php

namespace App\Http\Controllers;

use App\Models\BusinessUser;
use Illuminate\Http\Request;
use DataTables;
// use App\Models\User;

class BusinessUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        if ($request->ajax()) {

            $data = BusinessUser::latest()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        // $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Show" class="show btn btn-primary btn-sm showBusinessUser">View</a>';

                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBusinessUser">Edit</a>';

                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBusinessUser">Delete</a>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        // $business_id = session()->get('business_id');
        // $business = Business::where(['business_id'=>$business_id, 'status' => 1])->orderBy('name','ASC')->get();

        return view('business_user.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        BusinessUser::updateOrCreate([
                    'id' => $request->business_user_id
                ],
                [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'name' => $request->name,
                    'business_user_email' => $request->business_user_email,
                    'contact' => $request->contact,
                    'status' => $request->status == true ? 1 : 0,
                ]);

        return response()->json(['success'=>'BusinessUser saved successfully.']);
    }

    public function show($id)
    {
        $business_user = BusinessUser::find($id);
        return view()->json($business_user);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BusinessUser  $business_user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $business_user = BusinessUser::find($id);
        return response()->json($business_user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusinessUser  $business_user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BusinessUser::find($id)->delete();

        return response()->json(['success'=>'BusinessUser deleted successfully.']);
    }
}

