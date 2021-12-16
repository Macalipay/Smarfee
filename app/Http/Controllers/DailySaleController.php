<?php

namespace App\Http\Controllers;

use App\DailySale;
use App\Inventory;
use App\Notification;
use Auth;
use Carbon\Carbon;
use App\Payment;
use App\Driver;
use Illuminate\Http\Request;

class DailySaleController extends Controller
{
    public function index()
    {
        $dt = Carbon::now();
        $daily_sales = DailySale::where('restaurant_id', Auth::user()->restaurant_id)->where(function($query){
            $query->where('payment_status', '!=', 'Paid')
                ->OrWhere('status', '!=', 'Delivered');
        })
        ->orderBy('id', 'desc')
        ->get();
        $inventories = Inventory::where('restaurant_id', Auth::user()->restaurant_id)->orderBy('id')->get();
        $drivers = Driver::where('restaurant_id', Auth::user()->restaurant_id)->orderBy('id')->get();
        
        return view('backend.pages.sales.daily_sales', compact('daily_sales', 'inventories', 'drivers'));
    }

    public function driver()
    {
        $dt = Carbon::now();
        $daily_sales = DailySale::where('driver_id', Auth::user()->driver_id)->where('status', '!=', 'Cancelled')->where(function($query){
            $query->where('status', '!=', 'Delivered');
        })
        ->orderBy('id', 'desc')
        ->get();
        $inventories = Inventory::where('restaurant_id', Auth::user()->restaurant_id)->orderBy('id')->get();
        $drivers = Driver::where('restaurant_id', Auth::user()->restaurant_id)->orderBy('id')->get();
        return view('backend.pages.sales.driver', compact('daily_sales', 'inventories', 'drivers'));
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
        
        Notification::create([
            'daily_sale_id' => $product->id,
            'description' => 'Check Out',
        ]);

        DailySale::create($request->all());

        return redirect()->back()->with('success','Successfully Added');
    }

    public function edit($id)
    {
        $products = DailySale::where('id', $id)->with('user')->orderBy('id')->firstOrFail();
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

            Notification::create([
                'daily_sale_id' => $id,
                'description' => 'Paid',
            ]);

            DailySale::find($id)->update($request->all());
        } else {
            $request->merge([
                'balance' => $current_balance,
                'payment_status' => 'Unpaid'
            ]);

            Notification::create([
                'daily_sale_id' => $id,
                'description' => 'Unpaid',
            ]);

            DailySale::find($id)->update($request->all());
        }

        return redirect()->back()->with('success','Successfully Updated');
    }

    public function delivery(Request $request, $id)
    {
        DailySale::where('id', $id)->update(['delivery_charge' => $request->delivery_charge]);
        return redirect()->back()->with('success','Successfully Updated');
    }

    public function productionStatus(Request $request, $id)
    {
        if(Auth::user()->designation != 'Driver') {
            DailySale::where('id', $id)->update(['status' => $request->status, 'driver_id' => $request->driver_id]);
        } else {
            DailySale::where('id', $id)->update(['status' => $request->status, 'driver_id' => Auth::user()->driver_id]);
        }

        Notification::create([
            'daily_sale_id' => $id,
            'description' => $request->status,
            'user_id' => Auth::user()->id,
            'driver_id' => $request->driver_id,
        ]);

        return redirect()->back()->with('success','Successfully Updated');
    }

    public function cancelOrder(Request $request, $id)
    {
        // var_dump($request->production_status);die();
        DailySale::where('id', $id)->update(['description' => $request->description, 'status' => 'Cancelled', 'payment_status' => 'Paid']);

        Notification::create([
            'daily_sale_id' => $id,
            'description' => 'Cancelled',
            'user_id' => Auth::user()->id,
        ]);

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
