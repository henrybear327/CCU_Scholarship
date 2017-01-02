<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
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
        $users = DB::table('users')
                ->orderBy('user_type', 'asc')
                ->orderBy('student_id', 'asc')
                ->orderBy('email', 'asc')
                ->get();

        return view('admin.account', [
            "users" => $users,
        ]);
    }

    public function createAccountForFaculties()
    {
        $accountToCreate = [];

        // get all departments
        $departments = DB::table('departments')->get();
        $has_departments = DB::table('users')->whereNotNull('department_id')->get();

        foreach($departments as $department) {
            $has_entry = false;
            foreach($has_departments as $has_department) {
                if($department->department_id == $has_department->department_id) {
                    $has_entry = true;
                    break;
                }
            }

            if($has_entry == false) {
                array_push($accountToCreate, [
                    'name'          => $department->chinese_name,
                    'email'         => "department" . $department->department_id,
                    'password'      => bcrypt("default"),
                    'created_at'    => Carbon::now(),
                    'user_type'     => 2,
                    'department_id' => $department->department_id,
                ]);
            }
        }

        // get all colleges
        $colleges = DB::table('colleges')->get();
        $has_colleges = DB::table('users')->whereNotNull('college_id')->get();

        foreach($colleges as $college) {
            $has_entry = false;
            foreach($has_colleges as $has_college) {
                if($college->college_id == $has_college->college_id) {
                    $has_entry = true;
                    break;
                }
            }

            if($has_entry == false) {
                array_push($accountToCreate, [
                    'name'          => $college->chinese_name,
                    'email'         => "college" . $college->college_id,
                    'password'      => bcrypt("default"),
                    'created_at'    => Carbon::now(),
                    'user_type'     => 2,
                    'college_id'    => $college->college_id,
                ]);
            }
        }
        
        // create missing accounts
        DB::table('users')->insert($accountToCreate);

        return $this->showAllAccount();
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
