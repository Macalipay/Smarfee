<?php

namespace App\Http\Controllers;

use App\Payment;
use App\SalesOrder;
use Illuminate\Http\Request;
use Auth;


class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::orderBy('id', 'desc')->get();
        return view('backend.pages.sales_order.payment', compact('payments'));
    }

    public function store(Request $request)
    {
        $payment = $request->validate([
            'sales_order_id' => [ 'required', 'max:250'],
            'amount' => ['between:0,99.99', 'required', 'max:250'],
            'payment_type' => ['required', 'max:250'],
            'date' => ['required', 'max:250'],
        ]);

        $sales_order = SalesOrder::find($request->sales_order_id);
        
        $current_balance = $sales_order->balance - $request->amount;

        if($current_balance <= 0) {
            SalesOrder::where('id', $request->sales_order_id)->update(['balance' => $current_balance, 'status' => 'Paid']);
        } else {
            SalesOrder::where('id', $request->sales_order_id)->update(['balance' => $current_balance, 'status' => 'On-going']);
        }

        Payment::create($request->all());

        return redirect()->back()->with('success','Successfully Added');
    }

    public function edit($id)
    {
        $payments = Payment::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('payments'));
    }

    public function update(Request $request, $id)
    {

        $sales_order = SalesOrder::find($request->sales_order_id);
        $original_amount = Payment::where('id', $id)->first();

        $current_balance = $sales_order->balance + $original_amount->amount - $request->amount;

        
        if($current_balance <= 0) {
            SalesOrder::where('id', $request->sales_order_id)->update(['balance' => $current_balance, 'payment_status' => 'Paid']);
        } else {
            SalesOrder::where('id', $request->sales_order_id)->update(['balance' => $current_balance, 'payment_status' => 'Unpaid']);
        }

        Payment::find($id)->update($request->all());

        return redirect()->back()->with('success','Successfully Updated');
    }

    public function destroy($id)
    {
        $payment = Payment::find($id);
        $sales_order = SalesOrder::find($payment->sales_order_id);

        $current_balance = $sales_order->balance + $payment->amount;

        if($current_balance <= 0) {
            SalesOrder::where('id', $payment->sales_order_id)->update(['balance' => $current_balance, 'payment_status' => 'Paid']);
        } else {
            SalesOrder::where('id', $payment->sales_order_id)->update(['balance' => $current_balance, 'payment_status' => 'Unpaid']);
        }

        $payment->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
