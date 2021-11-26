<?php

namespace App\Http\Controllers;

use App\Restaurant;
use App\City;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::orderBy('id')->get();
        $cities = City::orderBy('id')->get();
        return view('backend.pages.restaurant', compact('restaurants', 'cities'));
    }

    public function store(Request $request)
    {
        $sales_order = $request->validate([
            'owner_name' => ['required', 'max:250'],
            'store_name' => ['required', 'max:250'],
            'address' => ['required', 'max:250'],
            'contact' => ['required', 'max:250'],
            'email' => ['required', 'max:250'],
            'status' => ['required', 'max:250'],
            'type' => ['required', 'max:250'],
            'map' => ['required', 'max:250'],
            'city_id' => ['required', 'max:250'],
            'image' => ['required'],
        ]);

        $file = $request->image->getClientOriginalName();
        $filename = pathinfo($file, PATHINFO_FILENAME);

        $imageName = $filename.time().'.'.$request->image->extension();  
        $image = $request->image->move(public_path('images/logo'), $imageName);

        $requestData = $request->all();
        $requestData['image'] = $imageName;

        $request->request->add(['restaurant_id' => Auth::user()->restaurant_id]);
        Restaurant::create($requestData);

        return redirect()->back()->with('success','Successfully Added');
    }

    public function edit($id)
    {
        $restaurant = Restaurant::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('restaurant'));
    }

    public function update(Request $request, $id)
    {
        Restaurant::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }

    public function destroy($id)
    {
        $barangay_destroy = Restaurant::find($id);
        $barangay_destroy->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
