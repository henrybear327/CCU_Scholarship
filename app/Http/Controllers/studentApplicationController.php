<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use DB;
use Storage;
use Validator;

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

    /**
     * Loads current semester's application form of the specific student.
     *
     * @return mixed view
     */
    public function showApplicationForm()
    {
        // get semester in use
        $currentSemester = DB::table('systemStatus')
            ->join('semesters', 'semesters.semester_id', '=', 'systemStatus.semester_id')
            ->where('in_use', '=', '1')
            ->get()
            ->first();

        // get the current application
        $show = DB::table('applicants')->where([['id', Auth::user()->id], ['semester_id', $currentSemester->semester_id]])
            ->first();

        $fileUrl = [];
        if ($show !== null) { // has draft in system
            // prepare the uploaded file url if exist
            if ($show->transcript_filename !== null) {
                $url = Storage::url("studentApplication/" . $show->transcript_filename);
                $fileUrl['transcript_url'] = $url;
            }

            if ($show->supportDocument_filename !== null) {
                $url = Storage::url("studentApplication/" . $show->supportDocument_filename);
                $fileUrl['supportDocument_url'] = $url;
            }
        }

        return view('student.applicationForm', ["show" => $show, "fileUrl" => $fileUrl]);
    }

    private function isFileTypeCorrect($request, $filename)
    {
        $extension = $request->file($filename)->extension();
        if ($extension === "pdf") {
            return true;
        }
        return false;
    }

    /**
     *  Checks the application form submission
     *
     *
     * @param Request $request
     * @return mixed view
     */
    public function addApplicationForm(Request $request)
    {
        // block submission before start
        $in_use = DB::table('systemStatus')->where('in_use', '=', '1')->get()->first();
        $parsedData = Carbon::parse($in_use->start_apply_date);
        if($in_use === null || $in_use->start_apply_date === null || Carbon::today()->lt($parsedData)) {
            $request->session()->flash('dateError', "申請尚未開放！ The application can't be submitted yet!");
            return $this->showApplicationForm();
        }

        // block submission after deadline
        // http://carbon.nesbot.com/docs/
        // get semester in use
        $in_use = DB::table('systemStatus')->where('in_use', '=', '1')->get()->first();
        $parsedData = Carbon::parse($in_use->end_apply_date);
        //dd($parsedData);
        //dd(Carbon::now());

        // use today() to compare with the parsed data (resulting in comparing only the date!)
        if(Carbon::today()->gt($parsedData)) {
            $request->session()->flash('dateError', "申請期限已過！ The application submission deadline has passed!");
            return $this->showApplicationForm();
        }

        // get semester in use
        $currentSemester = DB::table('systemStatus')
            ->join('semesters', 'semesters.semester_id', '=', 'systemStatus.semester_id')
            ->where('in_use', '=', '1')
            ->get()
            ->first();

        // TODO: limit file upload size
        if ($request->input('status') == 1) { // submission request
            // upon submission, validate all fields
            $validator = Validator::make($request->all(), [
                'Identity' => 'required',
                'Chinese_name' => 'required',
                'English_name' => 'required',
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

            // check if the file is uploaded

            // for identity = 0 (bachlor student), the transcript is required
            // for identity != 0 (master, PhD), the either transcript or supporting document is required
            $validator->after(function ($validator) use ($request, $currentSemester) {
                $data = DB::table('applicants')->where([['id', Auth::user()->id], ['semester_id', $currentSemester->semester_id]])
                    ->first();

                $noError = true;

                if ($data !== null) {
                    // has draft

                    if($request->input('Identity') == 0) {
                        // must have transcript
                        if ($data->transcript_filename === null
                            && ($request->hasFile('transcript') == false || $this->isFileTypeCorrect($request, "transcript") == false)
                        ) {
                            $validator->errors()->add('transcript_error', 'Here Please upload transcript as PDF');
                            $noError = false;
                        }
                    } else {
                        // check for wrong file type
                        if($request->hasFile('transcript') == true && $this->isFileTypeCorrect($request, "transcript") == false) {
                            $validator->errors()->add('transcript_error', 'Please upload transcript as PDF');
                            $noError = false;
                        }

                        if($request->hasFile('supportDocument') == true && $this->isFileTypeCorrect($request, "supportDocument") == false) {
                            $validator->errors()->add('supportDocument_error', 'Please upload supporting document as PDF');
                            $noError = false;
                        }

                        if($noError == true) {
                            // no error so far, check we have at least one document
                            $count_attachment = 0;

                            if ($request->hasFile('transcript') == true || $data->transcript_filename !== null)
                                $count_attachment++;
                            if ($request->hasFile('supportDocument') == true || $data->supportDocument_filename !== null)
                                $count_attachment++;

                            if($count_attachment == 0) {
                                $validator->errors()->add('noDocument_error', 'Please upload either transcript or supporting document as PDF');
                                $noError = false;
                            }
                        }
                    }
                } else {
                    // no draft yet!
                    if($request->input('Identity') == 0) {
                        // must have transcript
                        if ($request->hasFile('transcript') == false || $this->isFileTypeCorrect($request, "transcript") == false) {
                            $validator->errors()->add('transcript_error', 'Please upload transcript as PDF');
                            $noError = false;
                        }
                    } else {
                        $count_attachment = 0;

                        // check for wrong file type
                        if($request->hasFile('transcript') == true) {
                            if($this->isFileTypeCorrect($request, "transcript") == false) {
                                $validator->errors()->add('transcript_error', 'Please upload transcript as PDF');
                                $noError = false;
                            } else {
                                $count_attachment++;
                            }
                        }

                        if($request->hasFile('supportDocument') == true) {
                            if($this->isFileTypeCorrect($request, "supportDocument") == false) {
                                $validator->errors()->add('supportDocument_error', 'Please upload supporting document as PDF');
                                $noError = false;
                            } else {
                                $count_attachment++;
                            }
                        }

                        if($count_attachment == 0) {
                            $validator->errors()->add('noDocument_error', 'Please upload either transcript or supporting document as PDF');
                            $noError = false;
                        }
                    }
                }

                return $noError;
            });

            if ($validator->fails()) {
                return redirect('student/applicationForm')
                    ->withErrors($validator)
                    ->withInput();
            }
        } else {
            // TODO: Show error message after the file type check failed
            $this->validate($request, [
                'Identity' => 'integer',
                'Chinese_name' => 'string',
                'English_name' => 'string',
                'Nationality' => 'string',
                'Passport_num' => 'string',
                'sex' => 'integer',
                'ARC_num' => 'string',
                'phone_num' => 'string',
                'birthday' => 'date',
                'address' => 'string',
                'email' => 'email',
                'PastScholarship' => 'integer',
                'transcript' => 'mimetypes:application/pdf',
                'supportDocument' => 'mimetypes:application/pdf',
            ]);
        }

        // passed validation -> save it to the database

        // prepare data for DB query
        $dataForDB = [
            'id' => Auth::user()->id,
            'semester_id' => $currentSemester->semester_id,
            'Identity' => $request->input('Identity'),
            'Chinese_name' => $request->input('Chinese_name'),
            'English_name' => $request->input('English_name'),
            'Sex' => $request->input('sex'),
            'Nationality' => $request->input('Nationality'),
            'Passport_number' => $request->input('Passport_num'),
            'ARC_number' => $request->input('ARC_num'),
            'Phone_number' => $request->input('phone_num'),
            'Birthday' => $request->input('birthday'),
            'Address' => $request->input('address'),
            'Email' => $request->input('email'),
            'PastScholarship' => $request->input('PastScholarship'),
            'How_long' => $request->input('how_long'),
            'status' => $request->input('status'),
        ];

        // prepare file name for DB query
        if ($request->hasFile('transcript') && $request->file('transcript')->isValid()) {
            // TODO: delete old file if exist

            // prepare query
            $path = $request->file('transcript')->store('public/studentApplication'); // in studentApplication folder
            $hashName = $request->file('transcript')->hashName();

            $dataForDB['transcript_filename'] = $hashName;
        }

        if ($request->hasFile('supportDocument') && $request->file('supportDocument')->isValid()) {
            // TODO: delete old file if exist

            $path = $request->file('supportDocument')->store('public/studentApplication'); // in studentApplication folder
            $hashName = $request->file('supportDocument')->hashName();

            $dataForDB['supportDocument_filename'] = $hashName;
        }

        if (DB::table('applicants')->where([['id', Auth::user()->id], ['semester_id', $currentSemester->semester_id]])->count() == 0) {
            // no record yet, create a new one

            DB::table('applicants')->insert($dataForDB);
        } else {
            // block resubmission
            if(DB::table('applicants')->where([['id', Auth::user()->id], ['semester_id', $currentSemester->semester_id]])->first()->status == 1) {
                $request->session()->flash('resubmission', "你已經遞出申請了！申請表已經無法更改。 You have already submitted! The application can't be changed.");
                return $this->showApplicationForm();
            }

            // record exists, update it
            DB::table('applicants')->where([['id', Auth::user()->id], ['semester_id', $currentSemester->semester_id]])->update($dataForDB);
        }
        //return view('student.applicationForm');
        return $this->showApplicationForm();
    }

}
