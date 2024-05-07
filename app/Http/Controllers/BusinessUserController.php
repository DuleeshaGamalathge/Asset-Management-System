<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Business;
use App\Models\BusinessUser;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class BusinessUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $business_id = session()->get('business_id');
        $query = User::where('business_id',$business_id);

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
                        // $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Show" class="show btn btn-primary btn-sm showBusinessUser">View</a>';

                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBusinessUser">Edit</a>';

                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBusinessUser">Delete</a>';

                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
        }

        // $businesses = Business::all();

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
        // BusinessUser::updateOrCreate([
        //             'id' => $request->business_user_id
        //         ],
        //         [
        //             'first_name' => $request->first_name,
        //             'last_name' => $request->last_name,
        //             'name' => $request->name,
        //             'business_user_email' => $request->business_user_email,
        //             'contact' => $request->contact,
        //             'status' => $request->status == true ? 1 : 0,
        //             'business_id'=> $request->business_id
        //         ]);
        // Log the business_id retrieved from the session
    $business_id = session()->get('business_id');
    $password = Str::random(8);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        $user->contact = $request->contact;
        $user->status = $request->status == true ? 1:0;
        $user->business_id = $business_id;
        $user->password = Hash::make($password);
        // $user->assignRole('User');
        $user->save();

        return response()->json(['success'=>'BusinessUser saved successfully.']);
    }

    public function show($id)
    {
        $business_user = User::find($id);
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

        $business_user = User::find($id);
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
        User::find($id)->delete();

        return response()->json(['success'=>'BusinessUser deleted successfully.']);
    }
}

