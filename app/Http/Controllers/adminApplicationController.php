<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

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
                                ->where('semester_id', '=', $in_use->semester_id)
                                ->where('status', '=', '1')
                                ->get();
        
        return view('admin.application',['applicants' => $applicants]);
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
