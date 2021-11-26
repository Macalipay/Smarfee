<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::orderBy('id')->get();
        return view('frontend.master.template', compact('restaurants'));
    }
}
