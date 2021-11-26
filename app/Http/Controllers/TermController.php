<?php

namespace App\Http\Controllers;

use App\Term;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;


class TermController extends Controller
{
    public function index()
    {
        $terms = Term::where('restaurant_id', Auth::user()->restaurant_id)->orderBy('id')->get();
        return view('backend.pages.term', compact('terms'));
    }

    public function store(Request $request)
    {
        $sales_order = $request->validate([
            'term' => ['required', 'max:250'],
            'description' => ['required', 'max:250'],
        ]);

        $request->request->add(['created_user' => Auth::user()->id, 'restaurant_id' => Auth::user()->restaurant_id]);
        Term::create($request->all());

        return redirect()->back()->with('success','Successfully Added');
    }

    public function edit($id)
    {
        $term = Term::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('term'));
    }

    public function update(Request $request, $id)
    {
        Term::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }

    public function destroy($id)
    {
        $barangay_destroy = Term::find($id);
        $barangay_destroy->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
