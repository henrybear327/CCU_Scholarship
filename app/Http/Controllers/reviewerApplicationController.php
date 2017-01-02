<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Storage;

class reviewerApplicationController extends Controller
{
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

        if(Auth::user()->college_id !== null) {
            // get all applications of current semester, of the current department
            // if this is a college account, get all department id with the college_id = Auth::user()->college_id,
            // and get all applications of that department id set


        } else {
            // if this is a department account, get all applications of Auth::user()->department_id

            $applicants = DB::table('applicants')
                ->join('users','users.id','=','applicants.id')
                ->where('semester_id', '=', $in_use->semester_id)
                ->where('department_id', '=', Auth::user()->department_id)
                ->where('status', '=', '1')
                ->get();
        }

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

        return view('admin.application',['applicants' => $applicants, 'fileURL' => $fileURL]);
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
