<?php

namespace App\Http\Controllers;

use App\Shop;
use App\Rule;
use App\Term;
use App\Inventory;
use App\DailySale;
use App\Restaurant;
use App\Order;
use App\City;
use Auth;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Inventory::where('status', '!=', 'Out of Stock')->get();
        return view('frontend.pages.shop.pages.shop', compact('products'));
    }

    public function shop($id)
    {
        $restaurant = Restaurant::where('id', $id)->first();
        $terms = Term::where('restaurant_id', $id)->get();
        $rules = Rule::where('restaurant_id', $id)->get();
        $products = Inventory::where('restaurant_id', $id)->where('status', '!=', 'Out of Stock')->get();
        return view('frontend.pages.shop.pages.shop', compact('products', 'restaurant', 'terms', 'rules'));
    }


    public function history()
    {
        $sale = DailySale::where('user_id', Auth::user()->id)->where('payment_status', 'Unpaid')->first();
        if($sale != null) {
            $orders = Order::with('inventory')->where('daily_sale_id', $sale->id)->get();
        } else {
            $orders = Order::with('inventory')->where('daily_sale_id', 1000)->get();
        }
        $sales = DailySale::with('user')->where('user_id', Auth::user()->id)->where('payment_status', 'Paid')->get();
        
        return view('frontend.pages.shop.pages.history', compact('orders', 'sale', 'sales'));
    }

    public function login()
    {
        return view('frontend.pages.shop.pages.login');
    }

    public function register()
    {
        $cities = City::orderBy('id')->get();
        return view('frontend.pages.shop.pages.register', compact('cities'));
    }

    public function shopping_bag()
    {
        $sale = DailySale::where('user_id', Auth::user()->id)->where('payment_status', 'Unpaid')->firstOrFail();
        $orders = Order::with('inventory')->where('daily_sale_id', $sale->id)->get();
        return response()->json(compact('orders', 'sale'));
    }

    public function addCart(Request $request)
    {
        $product = $request->validate([
            'quantity' => ['required', 'max:250'],
            'inventory_id' => ['required', 'max:250'],
            'restaurant_id' => ['required', 'max:250'],
        ]);

        $inventory = Inventory::where('id', $request->inventory_id)->firstOrFail();
        $total = $request->quantity * $inventory->price;

        if(DailySale::where('user_id', Auth::user()->id)->where('payment_status', 'Unpaid')->exists()) {
            $sale = DailySale::where('user_id', Auth::user()->id)->where('payment_status', 'Unpaid')->firstOrFail();
            $new_total = $sale->amount + $total;
            $new_balance = $sale->balance + $total;

            DailySale::find($sale->id)->update(['amount' => $new_total, 'balance' => $new_balance]);

            $inventory = Inventory::where('id', $request->inventory_id)->firstOrFail();
            $new_inventory = $inventory->quantity_stock - $request->quantity;

            if($new_inventory <= $inventory->critical_level && $new_inventory > 0) {
                Inventory::find($request->inventory_id)->update(['quantity_stock' => $new_inventory, 'status' => 'Critical Level']);
            } else if($new_inventory <= 0) {
                Inventory::find($request->inventory_id)->update(['quantity_stock' => $new_inventory, 'status' => 'Out of Stock']);
            } else {
                Inventory::find($request->inventory_id)->update(['quantity_stock' => $new_inventory]);
            }

            $request->request->add(['daily_sale_id' => $sale->id, 'amount' => $inventory->price, 'total' => $total, 'restaurant_id' => $request->restaurant_id]);
            Order::create($request->all());
        } else {
            $sale = DailySale::create([
                'user_id' => Auth::user()->id,
                'description' => 'No Description',
                'amount' => $total,
                'balance' => $total,
                'payment_status' => 'Unpaid',
                'status' => 'Place Order',
                'restaurant_id' => $request->restaurant_id,
            ]);

            $inventory = Inventory::where('id', $request->inventory_id)->firstOrFail();
            $new_inventory = $inventory->quantity_stock - $request->quantity;

            if($new_inventory <= $inventory->critical_level && $new_inventory > 0) {
                Inventory::find($request->inventory_id)->update(['quantity_stock' => $new_inventory, 'status' => 'Critical Level']);
            } else if($new_inventory <= 0) {
                Inventory::find($request->inventory_id)->update(['quantity_stock' => $new_inventory, 'status' => 'Out of Stock']);
            } else {
                Inventory::find($request->inventory_id)->update(['quantity_stock' => $new_inventory]);
            }

            $request->request->add(['daily_sale_id' => $sale->id, 'amount' => $inventory->price, 'total' => $total, 'restaurant_id' => $request->restaurant_id]);
            Order::create($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function check_out(Request $request)
    {
        $daily_sale = $request->validate([
            'description' => ['max:250'],
        ]);

        $sale = DailySale::where('user_id', Auth::user()->id)->where('payment_status', 'Unpaid')->firstOrFail();
        DailySale::find($sale->id)->update(['status' => 'Check Out', 'description' => $request->description]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
