<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class studentApplicationController extends Controller
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

    public function showApplicationForm()
    {
        return view('student.applicationForm');
    }
    public function addApplicationForm(Request $request)
    {
        $this->validate($request, [
            'Identity' => 'required',
            'Chinese_name' => 'required',
            'English_name' => 'required',
            'student_ID' => 'required',
            'Department' => 'required',
            'Nationality' => 'required',
            'Passport_num' => 'required',
            'sex' => 'required',
            'ARC_num' => 'required',
            'phone_num' => 'required',
            'birthday' => 'required',
            'address' => 'required',
            'email' => 'required',
            'PastScholarship' => 'required',

        ]);
        dd($request);
        $currentSemester = DB::table('semesters')->
        select('semester_id')->
        orderBy('year', 'DESC')->
        orderBy('term', 'DESC')->first();

        //if($request->input('status') == 0)
        //{

            DB::table('applicants')->insert(
                [
                    'id' => Auth::user()->id,
                    'semester_id' => $currentSemester->semester_id,
                    'Identity' => $request->input('Identity'),
                    'Chinese_name' => $request->input('Chinese_name'),
                    'English_name' => $request->input('English_name'),
                    'student_id' => $request->input('student_ID'),
                    'department_id' => $request->input('Department'),
                    'Sex' => $request->input('sex'),
                    'Passport_number' => $request->input('Passport_num'),
                    'ARC_number' => $request->input('ARC_num'),
                    'Phone_number' => $request->input('phone_num'),
                    'Birthday' => $request->input('birthday'),
                    'Address' => $request->input('address'),
                    'Email' => $request->input('email'),
                    'PastScholarship' => $request->input('PastScholarship'),
                    'How_long' => $request->input('how_long'),
                    'status' => $request->input('status'),
                    'hash' => bcrypt($currentSemester->semester_id.$request->input('Identity').$request->input('Chinese_name').
                                     $request->input('English_name').$request->input('student_ID').$request->input('Department').
                                     $request->input('sex').$request->input('Passport_num').$request->input('ARC_num').
                                     $request->input('birthday').$request->input('email').$request->input('PastScholarship').
                                     $request->input('how_long')),
                ]
            );
        //}
        return view('student.applicationForm');
    }

}
