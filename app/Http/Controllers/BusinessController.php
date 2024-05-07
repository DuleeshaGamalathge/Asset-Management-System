<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use DataTables;
use App\Models\User;
use App\Models\InventoryCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = Business::latest()->get();

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
                    ->addColumn('user_status', function ($item) {
                        if ($item->user_status == 0) {
                            return '<span class="badge badge-danger">Inactive</span>';
                        }

                        if ($item->user_status == 1) {
                            return '<span class="badge badge-success">Active</span>';
                        }
                    })
                    ->addColumn('action', function($row){
                        // $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Show" class="show btn btn-primary btn-sm showBusiness">View</a>';

                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBusiness">Edit</a>';

                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBusiness">Delete</a>';

                        return $btn;
                    })
                    ->rawColumns(['action', 'status', 'user_status'])
                    ->make(true);
        }
        $businesses = Business::latest()->get();

        // $inventory_categories = InventoryCategory::all(); // Retrieve all categories
        // return view('layouts.dashboard', compact('inventory_categories'));

        return view('business.index', ['businesses'=>$businesses]);

    }

    public function create_form(Request $request){
        return view('business.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $password = Str::random(8);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->contact = $request->contact;
        $user->status = $request->status == true ? 1:0;
        $user->password = Hash::make($password);
        $user->assignRole('Admin');
        $user->save();

        // Ensure that user is created before proceeding
        if ($user) {
            $business = new Business();
            $business->name = $request->name;
            $business->business_email = $request->business_email;
            $business->street_no = $request->street_no;
            $business->address = $request->address;
            $business->city = $request->city;
            $business->status = $request->status == true ? 1 : 0;
            $business->user_id = $user->id;
            $business->save();

            // BusinessUser::create([
            //     'user_id' => $user->id,
            //     'business_id' => $business->id
            // ]);

            return response()->json(['success' => 'Business saved successfully.']);
        } else {
            return response()->json(['error' => 'Failed to save user.']);
        }

    }

    public function show($id)
    {
        $business = Business::find($id);
        return view()->json($business, $user);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $business = Business::find($id);
        return response()->json($business);
    }
    public function update(Request $request)
    {
        // Find the user by ID
        $id = $request->id;
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        // Update user fields
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->contact = $request->contact;
        $user->status = $request->status == true ? 1 : 0;
        $user->password = $user->password;
        $user->save();

        // Find the business associated with the user
        $business = Business::where('user_id', $id)->first();
        if (!$business) {
            return response()->json(['error' => 'Business not found.'], 404);
        }

        // Update business fields
        $business->name = $request->name;
            $business->business_email = $request->business_email;
            $business->street_no = $request->street_no;
            $business->address = $request->address;
            $business->city = $request->city;
            $business->status = $request->status == true ? 1 : 0;
            $business->user_id = $user->id;
        $business->save();

        return response()->json(['success' => 'User and Business updated successfully.']);
    }

//     public function edit($id)
// {
//     // Retrieve the business with its associated user
//     $business = Business::with('users')->find($id);

//     //Check if the business with the given ID exists
//     if (!$business) {
//         return response()->json(['error' => 'Business not found'], 404);
//     }

//     // Check if the associated user data is available
//     if (!$business->user) {
//         return response()->json(['error' => 'Associated user not found'], 404);
//     }

//     // Return the business data along with the associated user data
//     return response()->json($business);
// }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Business::find($id)->delete();

        return response()->json(['success'=>'Business deleted successfully.']);
    }


    public function move_to_dashboard(Request $request)
    {
        session()->put('business_id', $request->id);

        return response()->json(['status'=>true, 'message'=>'Business added to session']);
    }
}



