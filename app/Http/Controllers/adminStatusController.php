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

        return view('admin.systemStatus', [
            "semesters" => $semesters,
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
}
