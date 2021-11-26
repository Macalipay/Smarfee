<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Auth;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('restaurant_id', Auth::user()->restaurant_id)->orderBy('id')->get();
        return view('backend.pages.maintenance.product', compact('products'));
    }

    public function store(Request $request)
    {
        $product = $request->validate([
            'product' => ['required', 'max:250'],
        ]);

        $request->request->add(['created_user' => Auth::user()->id, 'restaurant_id' => Auth::user()->restaurant_id]);
        Product::create($request->all());

        return redirect()->back()->with('success','Successfully Added');
    }

    public function edit($id)
    {
        $products = Product::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('products'));
    }

    public function update(Request $request, $id)
    {
        Product::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }

    public function destroy($id)
    {
        $barangay_destroy = Product::find($id);
        $barangay_destroy->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
