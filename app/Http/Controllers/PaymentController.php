<?php

namespace App\Http\Controllers;

use App\Payment;
use App\DailySale;
use App\PaymentType;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::orderBy('id', 'desc')->get();
        return view('backend.pages.payment.payment', compact('payments'));
    }

    public function store(Request $request)
    {
        $payment = $request->validate([
            'dailysales_id' => [ 'required', 'max:250'],
            'amount' => ['between:0,99.99', 'required', 'max:250'],
            'payment' => ['required', 'max:250'],
            'date' => ['required', 'max:250'],
        ]);

        $daily_sale = DailySale::find($request->dailysales_id);
        
        $current_balance = $daily_sale->balance - $request->amount;

        if($current_balance <= 0) {
            DailySale::where('id', $request->dailysales_id)->update(['balance' => $current_balance, 'payment_status' => 'Paid', 'status' => 'Delivered']);
        } else {
            DailySale::where('id', $request->dailysales_id)->update(['balance' => $current_balance, 'payment_status' => 'Unpaid']);
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

        $daily_sale = DailySale::find($request->dailysales_id);
        $original_amount = Payment::where('id', $id)->first();

        $current_balance = $daily_sale->balance + $original_amount->amount - $request->amount;

        
        if($current_balance <= 0) {
            DailySale::where('id', $request->dailysales_id)->update(['balance' => $current_balance, 'payment_status' => 'Paid']);
        } else {
            DailySale::where('id', $request->dailysales_id)->update(['balance' => $current_balance, 'payment_status' => 'Unpaid']);
        }

        Payment::find($id)->update($request->all());

        return redirect()->back()->with('success','Successfully Updated');
    }

    public function destroy($id)
    {
        $payment = Payment::find($id);
        $daily_sale = DailySale::find($payment->dailysales_id);

        $current_balance = $daily_sale->balance + $payment->amount;

        if($current_balance <= 0) {
            DailySale::where('id', $payment->dailysales_id)->update(['balance' => $current_balance, 'payment_status' => 'Paid']);
        } else {
            DailySale::where('id', $payment->dailysales_id)->update(['balance' => $current_balance, 'payment_status' => 'Unpaid']);
        }

        $payment->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
