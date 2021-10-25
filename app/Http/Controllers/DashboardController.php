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
class DashboardController extends Controller
{
    public function index()
    {
        $dt = Carbon::now();
        $payments = Payment::where('date', $dt->toDateString())->orderBy('id', 'desc')->get();
        $daily_sale = Payment::where('date', $dt->toDateString())->sum('amount');
        $bpi = Payment::where('date', $dt->toDateString())->where('payment', 'BPI')->sum('amount');
        $bdo = Payment::where('date', $dt->toDateString())->where('payment', 'BDO')->sum('amount');
        $gcash = Payment::where('date', $dt->toDateString())->where('payment', 'GCASH')->sum('amount');
        $cash = Payment::where('date', $dt->toDateString())->where('payment', 'CASH')->sum('amount');
        $unpaid = DailySale::where('payment_status', 'Unpaid')->sum('balance');

        return view('backend.pages.dashboard.daily_dashboard', compact('unpaid', 'payments', 'daily_sale', 'bpi', 'bdo', 'gcash', 'cash', 'dt'));
    }

    public function filtering($date)
    {
        $dt = $date;
        $daily_sale = Payment::where('date', $date)->sum('amount');
        $expense = Expense::where('date', $date)->sum('amount');
        $bpi = Payment::where('date', $date)->where('payment_id', 1)->sum('amount');
        $bdo = Payment::where('date', $date)->where('payment_id', 2)->sum('amount');
        $gcash = Payment::where('date', $date)->where('payment_id', 3)->sum('amount');
        $cash = Payment::where('date', $date)->where('payment_id', 4)->sum('amount');
        $unpaid = DailySale::where('payment_status', 'Unpaid')->sum('balance');

        return response()->json(compact('daily_sale', 'bpi', 'bdo', 'gcash', 'cash', 'dt', 'expense'));
    }

    public function payment($date)
    {
        if(request()->ajax()) {
            return datatables()->of(Payment::where('date', $date)->with('paymentType', 'dailysale.customer')->get())
            ->addIndexColumn()
            ->make(true);
        }

        return response()->json(compact('paymentType'));
    }

  
    public function monthly()
    {
        $startDate  = Carbon::now();
        $monthly = Payment::whereBetween('date', [$startDate->firstOfMonth()->toDateString(), $startDate->endOfMonth()->toDateString()])->sum('amount');
        $expense = Expense::whereBetween('date', [$startDate->firstOfMonth()->toDateString(), $startDate->endOfMonth()->toDateString()])->sum('amount');

        $bpi_sale = Payment::whereBetween('date', [$startDate->firstOfMonth()->toDateString(), $startDate->endOfMonth()->toDateString()])->where('payment_id', 1)->sum('amount');
        $bdo_sale = Payment::whereBetween('date', [$startDate->firstOfMonth()->toDateString(), $startDate->endOfMonth()->toDateString()])->where('payment_id', 2)->sum('amount');
        $gcash_sale = Payment::whereBetween('date', [$startDate->firstOfMonth()->toDateString(), $startDate->endOfMonth()->toDateString()])->where('payment_id', 3)->sum('amount');
        $cash_sale = Payment::whereBetween('date', [$startDate->firstOfMonth()->toDateString(), $startDate->endOfMonth()->toDateString()])->where('payment_id', 4)->sum('amount');

        $bpi_expense = Expense::whereBetween('date', [$startDate->firstOfMonth()->toDateString(), $startDate->endOfMonth()->toDateString()])->where('paymenttype_id', 1)->sum('amount');
        $bdo_expense = Expense::whereBetween('date', [$startDate->firstOfMonth()->toDateString(), $startDate->endOfMonth()->toDateString()])->where('paymenttype_id', 2)->sum('amount');
        $gcash_expense = Expense::whereBetween('date', [$startDate->firstOfMonth()->toDateString(), $startDate->endOfMonth()->toDateString()])->where('paymenttype_id', 3)->sum('amount');
        $cash_expense = Expense::whereBetween('date', [$startDate->firstOfMonth()->toDateString(), $startDate->endOfMonth()->toDateString()])->where('paymenttype_id', 4)->sum('amount');

        $bpi = $bpi_sale - $bpi_expense;
        $bdo = $bdo_sale - $bdo_expense;
        $gcash = $gcash_sale - $gcash_expense;
        $cash = $cash_sale - $cash_expense;

        $sums=Payment::groupBy('date')->whereBetween('date', [$startDate->firstOfMonth()->toDateString(), $startDate->endOfMonth()->toDateString()])
                        ->selectRaw( "sum( amount ) as sum" )->get( "sum" ); 
        try {
            $average=$sums->sum("sum")/$sums->count();
        } catch (\Throwable $th) {
            $average= 0;
        }

        $piechart = Expense::groupBy('expensetype_id')->selectRaw('sum(amount) as amount, expensetype_id')->whereBetween('date', [$startDate->firstOfMonth()->toDateString(), 
                                    $startDate->endOfMonth()->toDateString()])->with('expense_type')->get();

        $daily_sales = Payment::groupBy('date')->selectRaw('sum(amount) as total, date')
                                    ->whereBetween('date', [$startDate->firstOfMonth()->toDateString(), 
                                    $startDate->endOfMonth()->toDateString()])->with('paymentType')->get();

        return view('backend.pages.dashboard.monthly_dashboard', compact('startDate', 'monthly', 'expense', 'average', 'piechart', 'daily_sales', 'bpi', 'bdo', 'gcash', 'cash'));
    }

    public function incomeExpense()
    {
        // $test  = Carbon::now();
        $startDate  = Carbon::now()->firstOfMonth();
        $endDate  = Carbon::now()->endOfMonth();

        $diff = $startDate->diffInDays($endDate);
        $payments = PaymentType::where('id', $id)->orderBy('id')->firstOrFail();

        return response()->json(compact('payments', 'diff'));
    }

    public function piechart()
    {
        $startDate  = Carbon::now();;
        $piechart = Expense::groupBy('expensetype_id')->selectRaw('sum(amount) as amount, expensetype_id')->whereBetween('date', [$startDate->firstOfMonth()->toDateString(), 
                                    $startDate->endOfMonth()->toDateString()])->with('expense_type')->get();

        return response()->json(compact('piechart'));
    }

    public function bargraph()
    {
        $startDate  = Carbon::now();
        $bargraph = Payment::groupBy('date')->selectRaw('sum(amount) as total, date')
                                    ->whereBetween('date', [$startDate->firstOfMonth()->toDateString(), 
                                    $startDate->endOfMonth()->toDateString()])->with('paymentType')->get();

        return response()->json(compact('bargraph'));
    }

    public function bargraph_expense()
    {
        $startDate  = Carbon::now();
        $bargraph = Expense::groupBy('date')->selectRaw('sum(amount) as total, date')
                                    ->whereBetween('date', [$startDate->firstOfMonth()->toDateString(), 
                                    $startDate->endOfMonth()->toDateString()])->with('payment_type')->get();

        return response()->json(compact('bargraph'));
    }

    public function masterfile()
    {
        $startDate  = Carbon::now();

        $sales = Payment::sum('amount');
        $expense = Expense::sum('amount');

        $cash_on_hand = $sales - $expense; 
        $cash_receivable = DailySale::where('payment_status', 'Unpaid')->sum('balance');

        
        $days = Payment::get()->groupBy('date');
        $total_days = $days->count();

        // BUDGET CONSUMED
        $total_utilities = ($sales * .04) - Expense::where('expensetype_id', 10)->sum('amount');
        $total_maintenance = ($sales * .02) - Expense::where('expensetype_id', 11)->sum('amount');
        $total_food = ($sales * .01) - Expense::where('expensetype_id', 12)->sum('amount');
        $total_supplies = ($sales * .36 ) - Expense::where('expensetype_id', 6)->sum('amount');
        $total_office_expense = ($sales * .01) - Expense::where('expensetype_id', 4)->sum('amount');
        $total_advertisement = (800 * $total_days) - Expense::where('expensetype_id', 13)->sum('amount');
        $total_rent = (600 * $total_days) - Expense::where('expensetype_id', 15)->sum('amount');
        $total_salaries = (3500 * $total_days) - Expense::where('expensetype_id', 9)->sum('amount');

        // ALLOTED BUDGET
        $utilities = $sales * .04;
        $maintenance = $sales * .02;
        $food = $sales * .01;
        $supplies = $sales * .36;
        $office_expense = $sales * .01;
        $advertisement = 800 * $total_days;
        $rent = 600 * $total_days;
        $salaries = 3500 * $total_days;

        
        $monthly = Payment::whereBetween('date', [$startDate->firstOfMonth()->toDateString(), $startDate->endOfMonth()->toDateString()])->sum('amount');

        $sums=Payment::groupBy('date')->selectRaw( "sum( amount ) as sum" )->get( "sum" ); 
        try {
            $average=$sums->sum("sum")/$sums->count();
        } catch (\Throwable $th) {
            $average= 0;
        }

        $piechart = Expense::groupBy('expensetype_id')->selectRaw('sum(amount) as amount, expensetype_id')->with('expense_type')->get();

        $monthly_sales = Payment::select(DB::raw('sum(amount) as total'), DB::raw('MONTH(date) as month'))
                                ->groupby('month')
                                ->get();

        return view('backend.pages.dashboard.master_file', compact('cash_on_hand', 'cash_receivable', 'startDate',
                                                                    'total_supplies', 'total_food', 'total_salaries', 'total_rent', 'total_utilities', 'total_maintenance', 'total_office_expense', 'total_advertisement',
                                                                    'supplies', 'food', 'salaries', 'rent', 'utilities', 'maintenance', 'office_expense', 'advertisement',
                                                                    'monthly', 'expense', 'average', 'piechart', 'monthly_sales'));
    }

    public function piechart_masterfile()
    {
        $startDate  = Carbon::now();;
        $piechart = Expense::groupBy('expensetype_id')->selectRaw('sum(amount) as amount, expensetype_id')->with('expense_type')->get();

        return response()->json(compact('piechart'));
    }

    public function bargraph_masterfile()
    {
        $startDate  = Carbon::now();
        $bargraph = Payment::select(DB::raw('sum(amount) as total'), DB::raw('MONTH(date) as month'))
                            ->groupby('month')
                            ->get();

        return response()->json(compact('bargraph'));
    }
}
