<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class adminApplicationController extends Controller
{
    /**
     * Create a new controller instance. Must be logged in to perform action on this controller
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showAllApplication()
    {
        return view('admin.application');
    }
}
