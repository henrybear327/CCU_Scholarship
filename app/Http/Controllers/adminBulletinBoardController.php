<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use DB;

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

    public function addPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        // dd($request);

        DB::table('bulletinBoard')->insert(
            [
                'title'         => $request->input('title'),
                'content'       => $request->input('content'),
                'created_at'    => Carbon::now(),
            ]
        );

        return redirect('administrator/bulletinBoard');
    }
    
}
