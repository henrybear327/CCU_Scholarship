<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Session;

class adminStatusController extends Controller
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

    public function showStatusSettings()
    {
        // get all semester
        $semesters = DB::table('semesters')->orderBy('year', 'desc')->orderBy('term', 'desc')->get();

        // get semester in use
        $in_use = DB::table('systemStatus')->where('in_use', '=', '1')->get()->first();

        return view('admin.systemStatus', [
            "semesters" => $semesters,
            "in_use"    => $in_use,
        ]);
    }

    /**
     * submit type 1 = new data for insertion
     * submit type 2 = edit of the existing data
     *
     * @param Request $request
     * @return mixed
     */
    public function addSemester(Request $request)
    {
        $this->validate($request, [
            'semester_id' => 'integer',
            'year' => 'required|integer',
            'term' => 'required|integer',
            'name' => 'required|string',
            'submitType' => 'required|integer|in:1,2',
        ]);

        // dd($request);

        if($request->input('submitType') == 1) {
            // 1 -> create
            DB::table('semesters')->insert(
                [
                    'year'       => $request->input('year'),
                    'term'       => $request->input('term'),
                    'name'       => $request->input('name'),
                    'created_at'    => Carbon::now(),
                ]
            );
        } else {
            // 2 -> edit
            DB::table('semesters')
                ->where('semester_id', $request->input('semester_id'))
                ->update(
                    [
                        'year'       => $request->input('year'),
                        'term'       => $request->input('term'),
                        'name'       => $request->input('name'),
                        'created_at'    => Carbon::now(),
                    ]
                );
        }

        // dd($request);
        return redirect('administrator/statusSetting');
    }

    /**
     * Load the data of the semester to edit from DB to the view
     *
     * @param $id
     * @return mixed
     */
    public function editSemester($id)
    {
        // post to edit
        $toEditSemester = DB::table('semesters')->where('semester_id', '=', $id)->get()->first();

        // get all semester
        $semesters = DB::table('semesters')->orderBy('year', 'desc')->orderBy('term', 'desc')->get();

        return view('admin.systemStatus', [
            "toEditSemester" => $toEditSemester,
            "semesters" => $semesters,
        ]);
    }

    public function setSemester(Request $request)
    {
        if(isset($request->semester_id) && $request->semester_id != -1) {
            // check if the semester have previous record
            $count = DB::table('systemStatus')->where('semester_id', '=', $request->semester_id)->count();

            // if no, insert
            if($count == 0) {
                // unset other in_use
                DB::table('systemStatus')
                    ->update(
                        [
                            'in_use' => 0,
                        ]
                    );

                DB::table('systemStatus')->insert(
                    [
                        'semester_id' => $request->input('semester_id'),
                        'created_at' => Carbon::now(),
                        'in_use' => 1,
                    ]
                );
            } else {
                // if yes, set in_use field!
                // unset other in_use
                DB::table('systemStatus')
                    ->update(
                        [
                            'in_use' => 0,
                        ]
                    );

                // set current id to in_use
                DB::table('systemStatus')
                    ->where('semester_id', "=", $request->input('semester_id'))
                    ->update(
                        [
                            'in_use' => 1,
                        ]
                    );
            }
        }

        return redirect('administrator/statusSetting');
    }
}
