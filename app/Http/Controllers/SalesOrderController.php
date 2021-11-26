<?php

namespace App\Http\Controllers;

use App\SalesOrder;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;

class SalesOrderController extends Controller
{
    public function index()
    {
        $sales_orders = SalesOrder::where('restaurant_id', Auth::user()->restaurant_id)->where('status', '!=', 'Completed')->where('status', '!=', 'Paid')->orderBy('id')->get();
        return view('backend.pages.sales_order.order', compact('sales_orders'));
    }

    public function complete()
    {
        $sales_orders = SalesOrder::where('status', '=', 'Completed')->orWhere('status', '=', 'Paid')->orderBy('id')->get();
        return view('backend.pages.sales_order.all_order', compact('sales_orders'));
    }

    public function store(Request $request)
    {
        $sales_order = $request->validate([
            'name' => ['required', 'max:250'],
            'order' => ['required', 'max:250'],
            'description' => ['required', 'max:250'],
            'quantity' => ['required', 'max:250'],
            'total_amount' => ['required', 'max:250'],
            'status' => ['required', 'max:250'],
        ]);

        $request->request->add(['balance' => $request->total_amount, 'created_user' => Auth::user()->id, 'restaurant_id' => Auth::user()->restaurant_id]);
        SalesOrder::create($request->all());

        return redirect()->back()->with('success','Successfully Added');
    }

    public function edit($id)
    {
        $sales_order = SalesOrder::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('sales_order'));
    }

    public function update(Request $request, $id)
    {
        SalesOrder::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }

    public function destroy($id)
    {
        $sales_order = SalesOrder::find($id);
        $sales_order->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
