<?php

namespace App\Http\Controllers;

use App\Dashboard;
use App\Payment;
use App\Expense;
use App\DailySale;
use App\RushFee;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
class DashboardController extends Controller
{
    public function index()
    {
        $dt = Carbon::now();
        $payments = Payment::where('restaurant_id', Auth::user()->restaurant_id)->where('date', $dt->toDateString())->orderBy('id', 'desc')->get();
        $daily_sale = Payment::where('restaurant_id', Auth::user()->restaurant_id)->where('date', $dt->toDateString())->sum('amount');
        $bpi = Payment::where('restaurant_id', Auth::user()->restaurant_id)->where('date', $dt->toDateString())->where('payment', 'BPI')->sum('amount');
        $bdo = Payment::where('restaurant_id', Auth::user()->restaurant_id)->where('date', $dt->toDateString())->where('payment', 'BDO')->sum('amount');
        $gcash = Payment::where('restaurant_id', Auth::user()->restaurant_id)->where('date', $dt->toDateString())->where('payment', 'GCASH')->sum('amount');
        $cash = Payment::where('restaurant_id', Auth::user()->restaurant_id)->where('date', $dt->toDateString())->where('payment', 'CASH')->sum('amount');
        $unpaid = DailySale::where('restaurant_id', Auth::user()->restaurant_id)->where('payment_status', 'Unpaid')->sum('balance');

        return view('backend.pages.dashboard.daily_dashboard', compact('unpaid', 'payments', 'daily_sale', 'bpi', 'bdo', 'gcash', 'cash', 'dt'));
    }

    public function filtering($date)
    {
        $dt = $date;
        $daily_sale = Payment::where('restaurant_id', Auth::user()->restaurant_id)->where('date', $date)->sum('amount');
        $expense = Expense::where('restaurant_id', Auth::user()->restaurant_id)->where('date', $date)->sum('amount');
        $bpi = Payment::where('restaurant_id', Auth::user()->restaurant_id)->where('date', $date)->where('payment_id', 1)->sum('amount');
        $bdo = Payment::where('restaurant_id', Auth::user()->restaurant_id)->where('date', $date)->where('payment_id', 2)->sum('amount');
        $gcash = Payment::where('restaurant_id', Auth::user()->restaurant_id)->where('date', $date)->where('payment_id', 3)->sum('amount');
        $cash = Payment::where('restaurant_id', Auth::user()->restaurant_id)->where('date', $date)->where('payment_id', 4)->sum('amount');
        $unpaid = DailySale::where('restaurant_id', Auth::user()->restaurant_id)->where('payment_status', 'Unpaid')->sum('balance');

        return response()->json(compact('daily_sale', 'bpi', 'bdo', 'gcash', 'cash', 'dt', 'expense'));
    }

    public function payment($date)
    {
        if(request()->ajax()) {
            return datatables()->of(Payment::where('restaurant_id', Auth::user()->restaurant_id)->where('date', $date)->with('paymentType', 'dailysale.customer')->get())
            ->addIndexColumn()
            ->make(true);
        }

        return response()->json(compact('paymentType'));
    }

  
    public function monthly()
    {
        // whereBetween('date', [$startDate->firstOfMonth()->toDateString(), $startDate->endOfMonth()->toDateString()])
        $startDate = Carbon::now();
        $dt = Carbon::now();
        $payments = Payment::where('restaurant_id', Auth::user()->restaurant_id)->whereBetween('date', [$startDate->firstOfMonth()->toDateString(), $startDate->endOfMonth()->toDateString()])->orderBy('id', 'desc')->get();
        $daily_sale = Payment::where('restaurant_id', Auth::user()->restaurant_id)->whereBetween('date', [$startDate->firstOfMonth()->toDateString(), $startDate->endOfMonth()->toDateString()])->sum('amount');
        $bpi = Payment::where('restaurant_id', Auth::user()->restaurant_id)->whereBetween('date', [$startDate->firstOfMonth()->toDateString(), $startDate->endOfMonth()->toDateString()])->where('payment', 'BPI')->sum('amount');
        $bdo = Payment::where('restaurant_id', Auth::user()->restaurant_id)->whereBetween('date', [$startDate->firstOfMonth()->toDateString(), $startDate->endOfMonth()->toDateString()])->where('payment', 'BDO')->sum('amount');
        $gcash = Payment::where('restaurant_id', Auth::user()->restaurant_id)->whereBetween('date', [$startDate->firstOfMonth()->toDateString(), $startDate->endOfMonth()->toDateString()])->where('payment', 'GCASH')->sum('amount');
        $cash = Payment::where('restaurant_id', Auth::user()->restaurant_id)->whereBetween('date', [$startDate->firstOfMonth()->toDateString(), $startDate->endOfMonth()->toDateString()])->where('payment', 'CASH')->sum('amount');
        $unpaid = DailySale::where('restaurant_id', Auth::user()->restaurant_id)->where('payment_status', 'Unpaid')->sum('balance');

        return view('backend.pages.dashboard.monthly_dashboard', compact('unpaid', 'payments', 'daily_sale', 'bpi', 'bdo', 'gcash', 'cash', 'dt'));
    }

    public function masterfile()
    {
        $dt = Carbon::now();
        $payments = Payment::where('restaurant_id', Auth::user()->restaurant_id)->orderBy('id', 'desc')->get();
        $daily_sale = Payment::where('restaurant_id', Auth::user()->restaurant_id)->sum('amount');
        $bpi = Payment::where('restaurant_id', Auth::user()->restaurant_id)->where('payment', 'BPI')->sum('amount');
        $bdo = Payment::where('restaurant_id', Auth::user()->restaurant_id)->where('payment', 'BDO')->sum('amount');
        $gcash = Payment::where('restaurant_id', Auth::user()->restaurant_id)->where('payment', 'GCASH')->sum('amount');
        $cash = Payment::where('restaurant_id', Auth::user()->restaurant_id)->where('payment', 'CASH')->sum('amount');
        $unpaid = DailySale::where('restaurant_id', Auth::user()->restaurant_id)->where('payment_status', 'Unpaid')->sum('balance');

        return view('backend.pages.dashboard.master_file', compact('unpaid', 'payments', 'daily_sale', 'bpi', 'bdo', 'gcash', 'cash', 'dt'));
    }
}
