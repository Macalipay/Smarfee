<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id')->get();
        return view('backend.pages.product', compact('products'));
    }

    public function store(Request $request)
    {
        $sales_order = $request->validate([
            'product_name' => ['required', 'max:250'],
            'description' => ['required', 'max:250'],
            'price' => ['required', 'max:250'],
            'image' => ['required', 'max:500'],
            'status' => ['required', 'max:250'],
        ]);

        $file = $request->image->getClientOriginalName();
        $filename = pathinfo($file, PATHINFO_FILENAME);

        $imageName = $filename.time().'.'.$request->image->extension();  
        $image = $request->image->move(public_path('images/product'), $imageName);

        $request->request->add(['created_user' => Auth::user()->id]);

        $requestData = $request->all();
        $requestData['image'] = $imageName;

        Product::create($requestData);

        return redirect()->back()->with('success','Successfully Added');
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('product'));
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
