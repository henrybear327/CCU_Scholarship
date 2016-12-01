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
        $applicants = DB::table('applicants')
                                ->join('users','users.id','=','applicants.id')
                                ->get();
        return view('admin.application',['applicants' => $applicants]);
    }

    public function updateAllApplication(Request $request) {
        // dd($request);
        $input = $request->input();

        $id = $input['id'];

        $fee1 = $input["fee1"];
        $fee2 = $input["fee2"];
        $fee3 = $input["fee3"];
        $fee4 = $input["fee4"];

        DB::table('applicants')
                    ->where('id', $id)
                    ->update(['reduce_tuition_percentage' => $fee1]);
        DB::table('applicants')
                    ->where('id', $id)
                    ->update(['reduce_miscellaneousFees_percentage' => $fee2]);
        DB::table('applicants')
                    ->where('id', $id)
                    ->update(['reduce_accommodation_percentage' => $fee3]);
        DB::table('applicants')
                    ->where('id', $id)
                    ->update(['livingExpense_amount' => $fee4]);



        $fee1_optional_input = $input["fee1_optional_input"];
        $fee2_optional_input = $input["fee2_optional_input"];
        $fee3_optional_input = $input["fee3_optional_input"];

        DB::table('applicants')
                    ->where('id', $id)
                    ->update(['reduce_tuition_amount' => $fee1_optional_input]);
        DB::table('applicants')
                    ->where('id', $id)
                    ->update(['reduce_miscellaneousFees_amount' => $fee2_optional_input]);
        DB::table('applicants')
                    ->where('id', $id)
                    ->update(['reduce_accommodation_amount' => $fee3_optional_input]);
        //
        // $applicants = DB::table('applicants')
        //                         ->join('users','users.id','=','applicants.id')
        //                         ->get();
        // return view('admin.application',['applicants' => $applicants]);

        return redirect('administrator/application');

    }
}
