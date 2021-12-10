<?php

namespace App\Http\Controllers;

use App\Driver;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::where('restaurant_id', Auth::user()->restaurant_id)->orderBy('id')->get();
        return view('backend.pages.driver', compact('drivers'));
    }

    public function store(Request $request)
    {
        $sales_order = $request->validate([
            'driver_name' => ['required', 'max:250'],
            'plate_no' => ['required', 'max:250'],
            'address' => ['required', 'max:250'],
            'contact' => ['required', 'max:250'],
            'email' => ['required', 'max:250'],
            'file' => ['required', 'max:500'],
            'status' => ['required', 'max:250'],
        ]);

        $file = $request->file->getClientOriginalName();
        $filename = pathinfo($file, PATHINFO_FILENAME);

        $imageName = $filename.time().'.'.$request->file->extension();  
        $file = $request->file->move(public_path('images/driver'), $imageName);

        $request->request->add(['created_user' => Auth::user()->id, 'restaurant_id' => Auth::user()->restaurant_id]);

        $requestData = $request->all();
        $requestData['file'] = $imageName;

        Driver::create($requestData);

        $latest_driver = Driver::orderBy('id', 'desc')->first();
        $last_user = User::select('id')->orderBy('id', 'desc')->first();

        ModelHasRole::create([
            'role_id' => 3,
            'model_type' => 'App\User',
            'model_id' => $last_user->id + 1,
        ]);

        User::create([
            'firstname' => $request->driver_name,
            'lastname' => $request->driver_name,
            'address' => $request->address,
            'designation' => 'Driver',
            'email' =>  $request->email,
            'contact_number' =>  $request->contact_number,
            'driver_id' =>  $latest_driver->id,
            'password' => '$2y$10$wDP43aejM.uAomThEV8teeI1hcBTBcjNNCSMOXftUe.6eu7ZlaPU6'
        ]);

        return redirect()->back()->with('success','Successfully Added');
    }

    public function edit($id)
    {
        $driver = Driver::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('driver'));
    }

    public function update(Request $request, $id)
    {
        Driver::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }

    public function destroy($id)
    {
        $barangay_destroy = Driver::find($id);
        $barangay_destroy->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
