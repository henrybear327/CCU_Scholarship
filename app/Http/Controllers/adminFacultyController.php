<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class adminFacultyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAllFaculty()
    {
        // update all faculty data before showing
        // The data may be 資訊工程學系（學士班） 資訊工程學系（博士班）
        // So we only take the part before (, and see if the database has that data

        // get all faculty data from student_data system
        $faculties = DB::connection('student_data')->table('students_inf')->select('dept')->distinct()->get();

        // get the department name part before (
        // http://stackoverflow.com/questions/2174362/remove-text-between-parentheses-php
        $departments = [];
        foreach($faculties as $faculty) {
            $results = explode("(", $faculty->dept);
            if(mb_strlen($results[0],'utf8') > 0)
                array_push($departments, $results[0]);
        }

        // add the missing department into the database
        foreach($departments as $department) {
            if(DB::table('departments')->where('chinese_name', '=', $department)->count() == 0) {
                // add this new department

                $dataForDB = [
                    'chinese_name'  => $department,
                    'created_at'    => Carbon::now(),
                ];
                DB::table('departments')->insert($dataForDB);
            }
        }

        // get all departments from our database
        $departments = DB::table('departments')
                        ->orderBy('chinese_name', 'asc')
                        ->get();

        // get all colleges from our database
        $colleges = DB::table('colleges')->get();

        return view('admin.faculty', ['departments' => $departments, 'colleges' => $colleges]);
    }

    public function setDepartmentCollege(Request $request)
    {
        if($request->has('under_college') && $request->get('under_college') !== -1) {
            DB::table('departments')
                ->where('department_id', '=', $request->department_id)
                ->update(['college_id' => $request->get('under_college')]);
        }

        return $this->showAllFaculty();
    }
}
