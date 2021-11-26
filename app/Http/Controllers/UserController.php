<?php

namespace App\Http\Controllers;

use App\User;
use App\Restaurant;
use App\ModelHasRole;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id')->where('designation', '!=' , 'Admin')->get();
        $restaurants = Restaurant::orderBy('id')->get();
        return view('backend.pages.user.user', compact('users', 'restaurants'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $last_user = User::select('id')->orderBy('id', 'desc')->first();

        $user = $request->validate([
            'firstname' => ['required', 'max:250'],
            'lastname' => ['required', 'max:250'],
            'address' => ['required', 'max:250'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact_number' => ['required', 'max:250'],
            'restaurant_id' => ['required', 'max:250'],
        ]);

        ModelHasRole::create([
            'role_id' => 2,
            'model_type' => 'App\User',
            'model_id' => $last_user->id + 1,
        ]);

        $request->request->add(['password' => '$2y$10$YngC733pnwE7QKLM65glCOjNFCX.8PKAzY0CquuH6UMd1qpTY/vYe', 'designation' => 'Owner']);
        User::create($request->all());

        return redirect()->back()->with('success','Successfully Added');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
       
    }

    public function changepass(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        Auth::logout();
        return redirect('/login');
    }

    public function changePicture(Request $request)
    {
        $request->validate([
            'picture' => 'required|jpeg,png,jpg,gif',
        ]);
   
        $file = $request->picture->getClientOriginalName();
        $filename = pathinfo($file, PATHINFO_FILENAME);

        $imageName = $filename.time().'.'.$request->picture->extension();  
        $picture = $request->picture->move(public_path('images/profile'), $imageName);

        $requestData = $request->all();
        $requestData['picture'] = $imageName;

        User::find(auth()->user()->id)->update(['picture'=> $imageName]);
        
        return redirect()->back()->with('success','Successfully Updated');
    }

    public function destroy($id)
    {
        //
    }
}
