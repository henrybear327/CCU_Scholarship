<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminStatusController extends Controller
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

    public function showStatusSettings()
    {
        return view('admin.systemStatus');
    }
}
