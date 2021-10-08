<?php

namespace App\Http\Controllers;

use App\Restaurant;
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
        return view('backend.pages.restaurant', compact('restaurants'));
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
        ]);

        $request->request->add(['created_user' => Auth::user()->id]);
        Restaurant::create($request->all());

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
