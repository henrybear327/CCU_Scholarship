<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminBulletinBoardController extends Controller
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

    public function showAllPost()
    {
        // get all post
        $posts = DB::table('bulletinBoard')->get();

        return view('admin.bulletinBoard', [
            "posts" => $posts,
        ]);
    }
    
}
