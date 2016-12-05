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
        $fees = DB::table('fees')->get();
        $caps = DB::table('caps')->get();
        return view('admin.capSetting', ['fees' => $fees], ['caps' => $caps]);
    }
    
    public function updateCurrentSetting(Request $request)
    {
        //dd($request->input('college_id'));
        if (DB::table('fees')->where('college_id', $request->input('college_id'))->count() == 0 && $request->input('submitType') == 1) {
            //dd($request);
            DB::table('fees')->insert(['semester_id' => 0,
                    'college_id' => ($request->input('college_id') <= 7) ? $request->input('college_id') : 0,
                    'department_id' => ($request->input('college_id') > 7) ? $request->input('college_id') : 0,
                    'tuition_base' => $request->input('tuition_base'),
                    'miscellaneousFees_base' => $request->input('miscellaneousFees_base'),
                    'accommodation_base' => $request->input('accommodation_base'),
                    'cost_of_living_base' => $request->input('cost_of_living_base'),

                ]
            );
        } else if (DB::table('fees')->where('college_id', $request->input('college_id'))->count() > 0 && $request->input('submitType') == 1) {
            DB::table('fees')->where('college_id', $request->input('college_id'))->
            update([
                'semester_id' => 0,
                'tuition_base' => $request->input('tuition_base'),
                'miscellaneousFees_base' => $request->input('miscellaneousFees_base'),
                'accommodation_base' => $request->input('accommodation_base'),
                'cost_of_living_base' => $request->input('cost_of_living_base'),
            ]);
        } else if (DB::table('caps')->where('college_id', $request->input('college_id'))->count() == 0 && $request->input('submitType') == 3) {
            //dd($request);
            DB::table('caps')->insert(['semester_id' => 0,
                    'college_id' => ($request->input('college_id') <= 7) ? $request->input('college_id') : 0,
                    'department_id' => ($request->input('college_id') > 7) ? $request->input('college_id') : 0,
                    'tuition_cap' => $request->input('tuition_cap'),
                    'miscellaneousFees_cap' => $request->input('miscellaneousFees_cap'),
                    'accommodation_cap' => $request->input('accommodation_cap'),
                    'cost_of_living_cap' => $request->input('cost_of_living_cap'),

                ]
            );
        } else if (DB::table('caps')->where('college_id', $request->input('college_id'))->count() > 0 && $request->input('submitType') == 3) {
            DB::table('caps')->where('college_id', $request->input('college_id'))->
            update([
                'semester_id' => 0,
                'tuition_cap' => $request->input('tuition_cap'),
                'miscellaneousFees_cap' => $request->input('miscellaneousFees_cap'),
                'accommodation_cap' => $request->input('accommodation_cap'),
                'cost_of_living_cap' => $request->input('cost_of_living_cap'),

            ]);
        }
        return $this->showCurrentSetting();
    }

    /* public function showCurrentSetting_cap()
      {
          $caps = DB::table('caps')->get();
          return view('admin.capSetting', );
      }
      public function updateCurrentSetting_cap(Request $request)
      {
        //dd($request->input('college_id'));


    }*/

}
