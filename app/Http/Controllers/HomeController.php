<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = \App\Contact::orderBy('last_name')->where('creator_id', '=', auth()->user()->id)->get();
        dd($contacts);
        return view('home', compact('contact'));
        
    }
}
