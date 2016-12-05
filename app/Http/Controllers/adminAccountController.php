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

    public function createAccount()
    {
        return view('admin.accountcreate');
    }

    public function Creating(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            // 'id' => 'required',
            'name' => 'required|max:255',
            'user_type' => 'required',
            'email' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
        //dd($request);
        DB::table('users')->insert([
            'name'       => $request->input('name'),
            'password'   => bcrypt($request->input('password')),
            'user_type'  => $request->input('user_type'),
            'email'       => $request->input('email'),
        ]);

        // dd($request);
        return redirect('administrator/accountManagement');
    }

    public function updateAccount(Request $request)
    {
        //dd($request);

        $this->validate($request, [
            'id' => 'required',
            'name' => 'required|max:255',
            'password' => 'required|min:6|confirmed',
        ]);

        DB::table('users')
            ->where('id', $request->input('id'))
            ->update(
            [
                'name'       => $request->input('name'),
                'password'   => bcrypt($request->input('password')),
            ]
        );

        // dd($request);
        return redirect('administrator/accountManagement');
    }

    public function editAccount($id)
    {
        // user to edit
        $toEditUser = DB::table('users')->where('id', '=', $id)->get();
        $toEditUser = $toEditUser->first();

        return view('admin.accountEdit', [
            "toEditUser" => $toEditUser,
        ]);
    }

    public function deleteAccount($id)
    {
        DB::table('users')->where('id', '=', $id)->delete();

        return redirect('administrator/accountManagement');
    }
}
