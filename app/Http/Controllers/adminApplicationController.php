<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Storage;

class adminApplicationController extends Controller
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

    public function showAllApplication()
    {
        // get semester in use
        $in_use = DB::table('systemStatus')->where('in_use', '=', '1')->get()->first();
        if($in_use === null) // semester not set
            return redirect()->action('adminStatusController@showStatusSettings');

        // get all applications of current semester
        $applicants = DB::table('applicants')
            ->join('users','users.id','=','applicants.id')
            ->where('applicants.semester_id', '=', $in_use->semester_id)
            ->where('applicants.status', '=', '1')
            ->join('departments', 'departments.department_id', '=', 'users.department_id')
            ->select('departments.chinese_name as department_name', 'applicants.*', 'users.*')
            ->get();

        // get all attachments of all applicants
        $fileURL = [];
        foreach($applicants as $applicant) {
            $fileURL[$applicant->applicant_id] = [];

            // transcript_filename
            if ($applicant->transcript_filename !== null) {
                $fileURL[$applicant->applicant_id]['transcript_url'] = Storage::url("studentApplication/" . $applicant->transcript_filename);
            }

            // supportDocument_filename
            if ($applicant->supportDocument_filename !== null) {
                $fileURL[$applicant->applicant_id]['supportDocument_url'] = Storage::url("studentApplication/" . $applicant->supportDocument_filename);
            }

            // attachment1_filename
            if ($applicant->attachment1_filename !== null) {
                $fileURL[$applicant->applicant_id]['attachment1_url'] = Storage::url("studentApplication/" . $applicant->attachment1_filename);
            }
        }

        // calculate amount to pay
        $toPay = [];
        foreach($applicants as $applicant) {
            // if no fee is set, return -1 -> N/A
            $total = 0;
            $tuition_base = 0;
            $miscellaneousFees_base = 0;
            $accommodation_base = 0;
            $cost_of_living_base = 0;

            // see use department fee or college fee
            $department_id = $applicant->department_id;

            if(DB::table('fees')
                    ->where('semester_id', '=', $in_use->semester_id)
                    ->where('department_id', '=', $department_id)
                    ->count() == 1) {
                // has department fee set
                $query = DB::table('fees')
                    ->where('semester_id', '=', $in_use->semester_id)
                    ->where('department_id', '=', $department_id)
                    ->get()->first();
                $tuition_base = $query->tuition_base;
                $miscellaneousFees_base = $query->miscellaneousFees_base;
                $accommodation_base = $query->accommodation_base;
                $cost_of_living_base = $query->cost_of_living_base;
            } else {
                $college_id = DB::table('departments')->where('department_id', '=', $department_id)->get()->first();
                if($college_id->college_id === null) {
                    $toPay[$applicant->applicant_id] = -1;
                    $total = -1;
                } else {
                    if(DB::table('fees')
                            ->where('semester_id', '=', $in_use->semester_id)
                            ->where('college_id', '=', $college_id->college_id)
                            ->count() == 1) {
                        // has college fee set
                        $query = DB::table('fees')
                            ->where('semester_id', '=', $in_use->semester_id)
                            ->where('college_id', '=', $college_id->college_id)
                            ->get()->first();
                        $tuition_base = $query->tuition_base;
                        $miscellaneousFees_base = $query->miscellaneousFees_base;
                        $accommodation_base = $query->accommodation_base;
                        $cost_of_living_base = $query->cost_of_living_base;
                    } else {
                        $toPay[$applicant->applicant_id] = -1;
                        $total = -1;
                    }
                }
            }

            if($total == -1)
                continue;

            $total = $tuition_base + $miscellaneousFees_base + $accommodation_base;
            $total *= 1.0;

            // var_dump($total);

            if($applicant->reduce_tuition_percentage != "101") {
                // echo "Here1";
                $total -= $tuition_base * (1.0 * $applicant->reduce_tuition_percentage / 100);
            } else {
                // echo "Here2";
                $total -= $applicant->reduce_tuition_amount;
            }

            /*
            var_dump($applicant->reduce_tuition_percentage);
            var_dump($applicant->reduce_tuition_amount);
            var_dump($tuition_base * (1.0 * $applicant->reduce_tuition_percentage / 100));
            var_dump($total);
            */


            if($applicant->reduce_miscellaneousFees_percentage != "101") {
                $total -= $miscellaneousFees_base * (1.0 * $applicant->reduce_miscellaneousFees_percentage / 100);
            } else {
                $total -= $applicant->reduce_miscellaneousFees_amount;
            }

            // var_dump($miscellaneousFees_base * (1.0 * $applicant->reduce_miscellaneousFees_percentage / 100));
            // var_dump($total);


            if($applicant->reduce_accommodation_percentage != "101") {
                $total -= $accommodation_base * (1.0 * $applicant->reduce_accommodation_percentage / 100);
            } else {
                $total -= $applicant->reduce_accommodation_amount;
            }

            // var_dump($accommodation_base * (1.0 * $applicant->reduce_accommodation_percentage / 100));
            // var_dump($total);

            $toPay[$applicant->applicant_id] = round($total);
        }

        // dd($toPay);
        
        return view('admin.application',['applicants' => $applicants, 'fileURL' => $fileURL, 'toPay' => $toPay]);
    }

    public function updateAllApplication(Request $request) {
        $input = $request->input();
        
        $id = $input['id'];

        $fee1 = $input["fee1"];
        $fee2 = $input["fee2"];
        $fee3 = $input["fee3"];
        $fee4 = $input["fee4"];


        $fee1_optional_input = $input["fee1_optional_input"];
        $fee2_optional_input = $input["fee2_optional_input"];
        $fee3_optional_input = $input["fee3_optional_input"];

        if($fee1 != 101) {
            $fee1_optional_input = 0;
        }

        if($fee2 != 101) {
            $fee2_optional_input = 0;
        }

        if($fee3 != 101) {
            $fee3_optional_input = 0;
        }


        DB::table('applicants')
                    ->where('id', $id)
                    ->update([
                        'reduce_tuition_percentage' => $fee1,
                        'reduce_miscellaneousFees_percentage' => $fee2,
                        'reduce_accommodation_percentage' => $fee3,
                        'livingExpense_amount' => $fee4,
                        'reduce_tuition_amount' => $fee1_optional_input,
                        'reduce_miscellaneousFees_amount' => $fee2_optional_input,
                        'reduce_accommodation_amount' => $fee3_optional_input
                    ]);

        // $applicants = DB::table('applicants')
        //                         ->join('users','users.id','=','applicants.id')
        //                         ->get();
        // return view('admin.application',['applicants' => $applicants]);

        return redirect('administrator/application');

    }
}
