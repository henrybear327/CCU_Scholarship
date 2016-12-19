<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
        // get semester in use
        $in_use = DB::table('systemStatus')->where('in_use', '=', '1')->get()->first();

        return view('home', [
            "in_use" => $in_use,
        ]);
    }
}
