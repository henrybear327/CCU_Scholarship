<?php

namespace App\Http\Controllers;

use DB;
use Carborn\Carbon;
use Illuminate\Http\Request;

class adminCapSettingController extends Controller
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

    public function showCurrentSetting()
    {
        // get semester in use
        $in_use = DB::table('systemStatus')->where('in_use', '=', '1')->get()->first();
        if($in_use === null) {
            return redirect()->action('adminStatusController@showStatusSettings');
        }

        // get fees of all colleges and departments
        $fees_departments = DB::table('fees')
            ->join('departments', 'departments.department_id', '=', 'fees.department_id')
            ->where('semester_id', '=', $in_use->semester_id)
            ->get();

        $fees_colleges = DB::table('fees')
            ->join('colleges', 'colleges.college_id', '=', 'fees.college_id')
            ->where('semester_id', '=', $in_use->semester_id)
            ->get();

        $fees = [];
        foreach($fees_departments as $fees_department) {
            array_push($fees, $fees_department);
        }
        foreach ($fees_colleges as $fees_college) {
            array_push($fees, $fees_college);
        }

        // get all faculties of colleges and departments
        $allFaculties = [];
        $faculties = DB::table('colleges')->get();
        foreach($faculties as $faculty) {
            $faculty = (Array)$faculty;

            $faculty['faculty_id'] = "college-" . $faculty['college_id'];

            array_push($allFaculties, $faculty);
        }

        $faculties = DB::table('departments')->get();
        foreach($faculties as $faculty) {
            $faculty = (Array)$faculty;

            $faculty['faculty_id'] = "department-" . $faculty['department_id'];

            array_push($allFaculties, $faculty);
        }

        // dd($allFaculties);

        if ($in_use->reviewByCollege == 1) {
            // reviewByCollege == 1, list colleges
            $faculties = DB::table('colleges')->get();

            $caps = DB::table('caps')
                    ->join('colleges', 'colleges.college_id', '=', 'caps.college_id')
                    ->where('semester_id', '=', $in_use->semester_id)
                    ->get();
        } else {
            // reviewByCollege == 0, list all department
            $faculties = DB::table('departments')->get();

            $caps = DB::table('caps')
                    ->join('departments', 'departments.department_id', '=', 'caps.department_id')
                    ->where('semester_id', '=', $in_use->semester_id)
                    ->get();
        }

        return view('admin.capSetting', ['fees' => $fees, 'caps' => $caps,
                                         'faculties' => $faculties, 'allFaculties' => $allFaculties]);
    }

    public function updateCurrentSetting(Request $request)
    {
        //dd($request->input('college_id'));
        // get semester in use
        $in_use = DB::table('systemStatus')->where('in_use', '=', '1')->get()->first();
        if($in_use === null)
            return $this->showCurrentSetting();

        // update base
        if($request->input('submitType') == 1) {
            // determine college or department
            $tokens = explode("-", $request->faculty_id);
            $id = $tokens[1];

            if($tokens[0] == "department") { // update department
                if(DB::table('fees')->where('department_id', $id)->count() == 0) {
                    DB::table('fees')->insert([
                            'semester_id' => $in_use->semester_id,
                            'department_id' => $id,
                            'tuition_base' => $request->input('tuition_base'),
                            'miscellaneousFees_base' => $request->input('miscellaneousFees_base'),
                            'accommodation_base' => $request->input('accommodation_base'),
                            'cost_of_living_base' => $request->input('cost_of_living_base'),
                        ]
                    );
                } else {
                    DB::table('fees')->where('department_id', $id)->update([
                        'department_id' => $in_use->semester_id,
                        'tuition_base' => $request->input('tuition_base'),
                        'miscellaneousFees_base' => $request->input('miscellaneousFees_base'),
                        'accommodation_base' => $request->input('accommodation_base'),
                        'cost_of_living_base' => $request->input('cost_of_living_base'),
                    ]);
                }
            } else { // update college
                if(DB::table('fees')->where('college_id', $id)->count() == 0) {
                    DB::table('fees')->insert([
                            'semester_id' => $in_use->semester_id,
                            'college_id' => $id,
                            'tuition_base' => $request->input('tuition_base'),
                            'miscellaneousFees_base' => $request->input('miscellaneousFees_base'),
                            'accommodation_base' => $request->input('accommodation_base'),
                            'cost_of_living_base' => $request->input('cost_of_living_base'),
                        ]
                    );
                } else {
                    DB::table('fees')->where('college_id', $id)->update([
                        'semester_id' => $in_use->semester_id,
                        'tuition_base' => $request->input('tuition_base'),
                        'miscellaneousFees_base' => $request->input('miscellaneousFees_base'),
                        'accommodation_base' => $request->input('accommodation_base'),
                        'cost_of_living_base' => $request->input('cost_of_living_base'),
                    ]);
                }
            }
        }

        // update cap
        if($request->input('submitType') == 3) {
            if($in_use->reviewByCollege == 1) {
                if(DB::table('caps')->where('college_id', $request->input('faculty_id'))->count() == 0) {
                    DB::table('caps')->insert([
                            'semester_id' => $in_use->semester_id,
                            'college_id' => $request->faculty_id,
                            'tuition_cap' => $request->input('tuition_cap'),
                            'miscellaneousFees_cap' => $request->input('miscellaneousFees_cap'),
                            'accommodation_cap' => $request->input('accommodation_cap'),
                            'cost_of_living_cap' => $request->input('cost_of_living_cap'),
                        ]
                    );
                } else {
                    DB::table('caps')->where('college_id', $request->input('faculty_id'))->update([
                        'semester_id' => $in_use->semester_id,
                        'tuition_cap' => $request->input('tuition_cap'),
                        'miscellaneousFees_cap' => $request->input('miscellaneousFees_cap'),
                        'accommodation_cap' => $request->input('accommodation_cap'),
                        'cost_of_living_cap' => $request->input('cost_of_living_cap'),
                    ]);
                }
            } else {
                if(DB::table('caps')->where('department_id', $request->input('faculty_id'))->count() == 0) {
                    DB::table('caps')->insert([
                            'semester_id' => $in_use->semester_id,
                            'department_id' => $request->faculty_id,
                            'tuition_cap' => $request->input('tuition_cap'),
                            'miscellaneousFees_cap' => $request->input('miscellaneousFees_cap'),
                            'accommodation_cap' => $request->input('accommodation_cap'),
                            'cost_of_living_cap' => $request->input('cost_of_living_cap'),
                        ]
                    );
                } else {
                    DB::table('caps')->where('department_id', $request->input('faculty_id'))->update([
                        'department_id' => $in_use->semester_id,
                        'tuition_cap' => $request->input('tuition_cap'),
                        'miscellaneousFees_cap' => $request->input('miscellaneousFees_cap'),
                        'accommodation_cap' => $request->input('accommodation_cap'),
                        'cost_of_living_cap' => $request->input('cost_of_living_cap'),
                    ]);
                }
            }
        }

        return $this->showCurrentSetting();
    }

}
