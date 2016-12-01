<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    }

}
