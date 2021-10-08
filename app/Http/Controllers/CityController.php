<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::orderBy('id')->get();
        return view('backend.pages.city', compact('cities'));
    }

    public function store(Request $request)
    {
        $sales_order = $request->validate([
            'city_code' => ['required', 'max:250'],
            'city_name' => ['required', 'max:250'],
        ]);

        $request->request->add(['created_user' => Auth::user()->id]);
        City::create($request->all());

        return redirect()->back()->with('success','Successfully Added');
    }

    public function edit($id)
    {
        $city = City::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('city'));
    }

    public function update(Request $request, $id)
    {
        City::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }

    public function destroy($id)
    {
        $barangay_destroy = City::find($id);
        $barangay_destroy->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
