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

    public function addAccount(Request $request)
    {
        // $this->validate($request, [
        //     'post_id' => 'required',
        //     'title' => 'required',
        //     'content' => 'required',
        //     'submitType' => 'required',
        // ]);

        // dd($request);

        if($request->input('submitType') == 1) {
            // 1 -> create
            DB::table('users')->insert(
                [
                    'name'         => $request->input('name'),
                    'email'        => $request->input('email'),
                    'password'     => $request->input('password'),
                ]
            );
        } else {
            // 2 -> edit
            DB::table('users')
                ->where('id', $request->input('id'))
                ->update(
                [
                    'name'         => $request->input('name'),
                    'email'        => $request->input('email'),
                    'password'     => $request->input('password'),
                ]
            );
        }

        // dd($request);

        return redirect('administrator/accountManagement');
    }

    public function editAccount($id)
    {
        $users = DB::table('users')->get();

        $toEditAccount = DB::table('users')->where('id', '=', $id)->get();
        $toEditAccount = $toEditAccount->first();

        return view('admin.account', [
            "users" => $users,
            "toEditAccount" => $toEditAccount,
        ]);
    }

    public function deleteAccount($id)
    {
        DB::table('users')->where('id', '=', $id)->delete();

        return redirect('administrator/accountManagement');
    }
}
