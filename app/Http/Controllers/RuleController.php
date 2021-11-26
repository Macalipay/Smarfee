<?php

namespace App\Http\Controllers;

use App\Rule;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;

class RuleController extends Controller
{
    public function index()
    {
        $rules = Rule::where('restaurant_id', Auth::user()->restaurant_id)->orderBy('id')->get();
        return view('backend.pages.rule', compact('rules'));
    }

    public function store(Request $request)
    {
        $sales_order = $request->validate([
            'rule' => ['required', 'max:250'],
            'description' => ['required', 'max:250'],
        ]);

        $request->request->add(['created_user' => Auth::user()->id, 'restaurant_id' => Auth::user()->restaurant_id]);
        Rule::create($request->all());

        return redirect()->back()->with('success','Successfully Added');
    }

    public function edit($id)
    {
        $rule = Rule::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('rule'));
    }

    public function update(Request $request, $id)
    {
        Rule::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }

    public function destroy($id)
    {
        $barangay_destroy = Rule::find($id);
        $barangay_destroy->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
