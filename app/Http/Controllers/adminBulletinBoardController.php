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
            'post_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'submitType' => 'required',
        ]);

        // dd($request);

        if($request->input('submitType') == 1) {
            // 1 -> create
            DB::table('bulletinBoard')->insert(
                [
                    'title'         => $request->input('title'),
                    'content'       => $request->input('content'),
                    'created_at'    => Carbon::now(),
                ]
            );
        } else {
            // 2 -> edit
            DB::table('bulletinBoard')
                ->where('post_id', $request->input('post_id'))
                ->update(
                [
                    'title'         => $request->input('title'),
                    'content'       => $request->input('content'),
                    'updated_at'    => Carbon::now(),
                ]
            );
        }

        // dd($request);

        return redirect('administrator/bulletinBoard');
    }

    public function editPost($id)
    {
        // get all post
        $posts = DB::table('bulletinBoard')->get();

        // post to edit
        $toEditPost = DB::table('bulletinBoard')->where('post_id', '=', $id)->get();
        $toEditPost = $toEditPost->first();

        return view('admin.bulletinBoard', [
            "toEditPost" => $toEditPost,
            "posts" => $posts,
        ]);
    }

    public function deletePost($id)
    {
        DB::table('bulletinBoard')->where('post_id', '=', $id)->delete();

        return redirect('administrator/bulletinBoard');
    }
}
