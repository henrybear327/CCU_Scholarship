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
        // get current semester
        $currentSemester = DB::table('semesters')->
        select('semester_id')->
        orderBy('year', 'DESC')->
        orderBy('term', 'DESC')->first();

        // get the current application
        $show = DB::table('applicants')->where([['id', Auth::user()->id], ['semester_id', $currentSemester->semester_id]])
            ->first();

        return view('student.applicationForm', ["show" => $show]);
    }

    public function addApplicationForm(Request $request)
    {
        if ($request->input('status') == 1) {
            // upon submission, validate all fields
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
        }

        // if validation succeeded, or this is just a draft -> save it to the database
        $currentSemester = DB::table('semesters')->
        select('semester_id')->
        orderBy('year', 'DESC')->
        orderBy('term', 'DESC')->first();

        $dataForDB = [
            'id' => Auth::user()->id,
            'semester_id' => $currentSemester->semester_id,
            'Identity' => $request->input('Identity'),
            'Chinese_name' => $request->input('Chinese_name'),
            'English_name' => $request->input('English_name'),
            'Nationality' => $request->input('Nationality'),
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
        ];

        if (DB::table('applicants')->where([['id', Auth::user()->id], ['semester_id', $currentSemester->semester_id]])->count() == 0) {
            // no record yet, create a new one

            DB::table('applicants')->insert($dataForDB);
        } else {
            // record exists, update it

            DB::table('applicants')->where([['id', Auth::user()->id], ['semester_id', $currentSemester->semester_id]])->update($dataForDB);
        }
        
        //return view('student.applicationForm');
        return $this->showApplicationForm();
    }

}
