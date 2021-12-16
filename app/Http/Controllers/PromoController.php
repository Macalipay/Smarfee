<?php

namespace App\Http\Controllers;

use App\Promo;
use App\Inventory;
use Auth;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::orderBy('id')->get();
        $products = Inventory::where('restaurant_id', Auth::user()->restaurant_id)->orderBy('id')->get();
        return view('backend.pages.promo', compact('promos', 'products'));
    }

    public function store(Request $request)
    {
        $sales_order = $request->validate([
            'inventory_id' => ['required', 'max:250'],
            'discount' => ['required', 'max:250'],
        ]);

        $request->request->add(['created_user' => Auth::user()->id]);
        Promo::create($request->all());

        return redirect()->back()->with('success','Successfully Added');
    }

    public function edit($id)
    {
        $promo = Promo::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('promo'));
    }

    public function update(Request $request, $id)
    {
        Promo::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }

    public function destroy($id)
    {
        $barangay_destroy = Promo::find($id);
        $barangay_destroy->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
