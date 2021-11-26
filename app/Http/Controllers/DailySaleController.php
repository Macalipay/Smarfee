<?php

namespace App\Http\Controllers;

use App\DailySale;
use App\Inventory;
use Auth;
use Carbon\Carbon;
use App\Payment;
use Illuminate\Http\Request;

class DailySaleController extends Controller
{
    public function index()
    {
        $dt = Carbon::now();
        $daily_sales = DailySale::where('restaurant_id', Auth::user()->restaurant_id)->where('payment_status', '!=', 'Paid')->where('status', 'Check Out')->orderBy('id', 'desc')->get();
        $inventories = Inventory::where('restaurant_id', Auth::user()->restaurant_id)->orderBy('id')->get();
        return view('backend.pages.sales.daily_sales', compact('daily_sales', 'inventories'));
    }

    public function all()
    {
        $dt = Carbon::now();
        $daily_sales = DailySale::where('restaurant_id', Auth::user()->restaurant_id)->orderBy('id', 'desc')->get();
        $daily_sale = Payment::where('restaurant_id', Auth::user()->restaurant_id)->where('date', $dt->toDateString())->sum('amount');
        $unpaid = DailySale::where('restaurant_id', Auth::user()->restaurant_id)->where('payment_status', 'Unpaid')->sum('balance');
        return view('backend.pages.sales.all_sales', compact('daily_sales', 'daily_sale', 'unpaid'));
    }

    public function store(Request $request)
    {
        $product = $request->validate([
            'user_id' => ['required', 'max:250'],
            'inventory_id' => ['required', 'max:250'],
            'description' => ['required', 'max:250'],
            'amount' => ['required', 'max:250'],
            'balance' => ['required', 'max:250'],
            'payment_status' => ['required', 'max:250'],
        ]);

        $request->request->add(['balance' => $request->amount, 'restaurant_id' => Auth::user()->restaurant_id]);
        
        DailySale::create($request->all());

        return redirect()->back()->with('success','Successfully Added');
    }

    public function edit($id)
    {
        $products = DailySale::where('id', $id)->with('customer')->orderBy('id')->firstOrFail();
        return response()->json(compact('products'));
    }

    public function update(Request $request, $id)
    {
        $daily_sale = DailySale::find($id);

        $amount = $daily_sale->amount - $request->amount;
        $current_balance = $daily_sale->balance - $amount;
        
        if($current_balance <= 0) {
            $request->merge([
                'balance' => $current_balance,
                'payment_status' => 'Paid'
            ]);
            DailySale::find($id)->update($request->all());
        } else {
            $request->merge([
                'balance' => $current_balance,
                'payment_status' => 'Unpaid'
            ]);
            DailySale::find($id)->update($request->all());
        }

        return redirect()->back()->with('success','Successfully Updated');
    }

    public function productionStatus(Request $request, $id)
    {
        // var_dump($request->production_status);die();
        DailySale::where('id', $id)->update(['production_status' => $request->production_status]);
        return redirect()->back()->with('success','Successfully Updated');
    }

    public function paymentStatus(Request $request, $id)
    {
        DailySale::where('id', $id)->update(['payment_status' => $request->payment_status]);
        return redirect()->back()->with('success','Successfully Updated');
    }

    public function destroy($id)
    {
        $barangay_destroy = DailySale::find($id);
        $barangay_destroy->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
