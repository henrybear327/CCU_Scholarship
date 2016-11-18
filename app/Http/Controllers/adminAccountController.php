<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class adminAccountController extends Controller
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

    /**
     * 把資料庫所有使用者的資料撈出
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAllAccount()
    {
        // get all users
        $users = DB::table('users')->get();

        return view('admin.account', [
            "users" => $users,
        ]);
    }
}
