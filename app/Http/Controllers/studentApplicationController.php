<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use DB;
use Storage;
use Validator;
use Session;

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
     * Process the form for scholarship rule
     *
     * @param Request $request
     * @return mixed
     */
    public function readRule(Request $request)
    {
        if($request->readRule == 1) {
            // get semester in use
            $currentSemester = DB::table('systemStatus')
                ->join('semesters', 'semesters.semester_id', '=', 'systemStatus.semester_id')
                ->where('in_use', '=', '1')
                ->get()
                ->first();

            // prepare data for DB query
            $dataForDB = [
                'id' => Auth::user()->id,
                'semester_id' => $currentSemester->semester_id,
                'has_read_rule' =>1,
            ];

            DB::table('applicants')->insert($dataForDB);
        }

        return $this->showApplicationForm();
    }

    /**
     * Associate a student ID with an account
     *
     * @param Request $request
     * @return mixed
     */
    public function addStudentID(Request $request)
    {
        if($request->has('student_id')) {
            // if the student id exists in the student data and the student id isn't taken yet
            if(DB::connection('student_data')->table('students_inf')->where('student_id', '=', $request->student_id)->count() > 0 &&
                DB::table('users')->where('student_id', '=', $request->student_id)->count() == 0) {
                // record the department id for the student
                $data = DB::connection('student_data')->table('students_inf')->where('student_id', '=', $request->student_id)->get()->first();

                $studentInDepartment = $data->dept;
                $studentInDepartment = explode("(", $studentInDepartment);
                $studentInDepartment = $studentInDepartment[0];

                $department = DB::table('departments')->where('chinese_name', '=', $studentInDepartment)->get()->first();
                
                DB::table('users')->where('id', '=', Auth::user()->id)->update([
                    'student_id'    => $request->student_id,
                    'department_id' => $department->department_id,
                ]);
                // Auth::user()->update(['student_id'=>$request->student_id]);
            } else {
                Session::flash('invalidStudentID', "The student ID entered is not found or is used already");
            }
        }

        return $this->showApplicationForm();
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

        if($currentSemester === null) { // no current semester -> system status not set properly by admin yet -> don't show the form
            return view('student.applicationForm', ["blockForm" => "The system is not configured properly! Please try again later."]);
        }

        // block submission before start
        $in_use = DB::table('systemStatus')->where('in_use', '=', '1')->get()->first();
        $parsedData = Carbon::parse($in_use->start_apply_date); // http://carbon.nesbot.com/docs/
        if($in_use === null || $in_use->start_apply_date === null || Carbon::today()->lt($parsedData)) {
            return view('student.applicationForm', ["blockForm" => "申請尚未開放！ The application can't be submitted yet!"]);
        }

        // block submission after deadline
        $parsedData = Carbon::parse($in_use->end_apply_date);

        // use today() to compare with the parsed data (resulting in comparing only the date!)
        if(Carbon::today()->gt($parsedData)) {
            // Session::flash('dateError', "申請期限已過！ The application submission deadline has passed!");
            return view('student.applicationForm', ["blockForm" => "申請期限已過！ The application submission deadline has passed!"]);
        }

        // check for student ID
        Auth::user()->fresh();
        $user = DB::table('users')->where('id', '=', Auth::user()->id)->get()->first();
        if($user->student_id === null) {
            return view('student.applicationForm', ["noStudentID" => 1]); // need to associate the account with the student ID before proceeding
        }

        // get the current application
        $show = DB::table('applicants')->where([['id', Auth::user()->id], ['semester_id', $currentSemester->semester_id]])
            ->first();

        // check if the rules have been read
        $ruleURL = $in_use->ruleURL;

        $fileUrl = [];
        if ($show !== null) { // has draft in system
            if($show->has_read_rule == 0) { // if rules not read, show the form for reading the rules
                return view('student.applicationForm', ["show" => $show, "fileUrl" => $fileUrl, "needToReadRule" => $ruleURL]);
            }

            // prepare the uploaded file url if exist
            if ($show->transcript_filename !== null) {
                $url = Storage::url("studentApplication/" . $show->transcript_filename);
                $fileUrl['transcript_url'] = $url;
            }

            if ($show->supportDocument_filename !== null) {
                $url = Storage::url("studentApplication/" . $show->supportDocument_filename);
                $fileUrl['supportDocument_url'] = $url;
            }

            if ($show->attachment1_filename !== null) {
                $url = Storage::url("studentApplication/" . $show->attachment1_filename);
                $fileUrl['attachment1_url'] = $url;
            }
        } else {
            // no draft -> rules not read yet -> show the form for reading the rules
            return view('student.applicationForm', ["show" => $show, "fileUrl" => $fileUrl, "needToReadRule" => $ruleURL]);
        }

        // show attachment1 form download link
        if ($in_use->attachment1 !== null) {
            $fileUrl['attachment1'] = Storage::url("systemStatus/" . $in_use->attachment1);
        }

        return view('student.applicationForm', ["show" => $show, "fileUrl" => $fileUrl]);
    }

    /**
     * Check if the uploaded attachment is in PDF format
     *
     * @param $request
     * @param $filename
     * @return bool
     */
    private function isFileTypeCorrect($request, $filename)
    {
        $extension = $request->file($filename)->extension();
        if ($extension === "pdf") {
            return true;
        }
        return false;
    }

    /**
     *  Check the application form submission
     *
     * @param Request $request
     * @return mixed view
     */
    public function addApplicationForm(Request $request)
    {
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
                'email' => 'required|email',
                'PastScholarship' => 'required',
                'declaration' => 'required',
            ]);

            // check if the file is uploaded and of the right type (PDF)

            // for identity = 0 (bachelor student), the transcript is required
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
                            $validator->errors()->add('transcript_error', 'Please upload transcript as PDF');
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

                // check attachment1
                if ($request->hasFile('attachment1') == false || $this->isFileTypeCorrect($request, "attachment1") == false) {
                    $validator->errors()->add('attachment1_error', 'Please upload attachment 1 as PDF');
                    $noError = false;
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
                'attachment1' => 'mimetypes:application/pdf',
                'transcript' => 'mimetypes:application/pdf',
                'supportDocument' => 'mimetypes:application/pdf',
            ]);
        }

        // passed validation -> save it to the database

        // prepare data for DB query
        $need_attachment2 = $request->has('need_attachment2') ? 1 : 0;
        if($request->has('Identity') && $request->input('Identity') == 0) {
            // bachelor student MUST submit attachment 2
            $need_attachment2 = 1;
        }

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
            'need_attachment2' => $need_attachment2,
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

        if ($request->hasFile('attachment1') && $request->file('attachment1')->isValid()) {
            // TODO: delete old file if exist

            $path = $request->file('attachment1')->store('public/studentApplication'); // in studentApplication folder
            $hashName = $request->file('attachment1')->hashName();

            $dataForDB['attachment1_filename'] = $hashName;
        }

        if (DB::table('applicants')->where([['id', Auth::user()->id], ['semester_id', $currentSemester->semester_id]])->count() == 0) {
            // no record yet, create a new one

            DB::table('applicants')->insert($dataForDB);
        } else {
            // block resubmission
            if(DB::table('applicants')->where([['id', Auth::user()->id], ['semester_id', $currentSemester->semester_id]])->first()->status == 1) {
                Session::flash('resubmission', "你已經遞出申請了！申請表已經無法更改。 You have already submitted! The application can't be changed.");
                return $this->showApplicationForm();
            }

            // record exists, update it
            DB::table('applicants')->where([['id', Auth::user()->id], ['semester_id', $currentSemester->semester_id]])->update($dataForDB);
        }
        //return view('student.applicationForm');
        return $this->showApplicationForm();
    }


    public function showApplicationResult()
    {
        // block submission before start
        $in_use = DB::table('systemStatus')->where('in_use', '=', '1')->get()->first();
        $parsedData = Carbon::parse($in_use->start_show_result_date); // http://carbon.nesbot.com/docs/
        if($in_use === null || $in_use->start_show_result_date === null || Carbon::today()->lt($parsedData)) {
            return view('student.result', ["errorMsg" => "結果尚未開放！ The result isn't released yet!"]);
        }

        $applicant = DB::table('applicants')
                    ->where('id', '=', Auth::user()->id)
                    ->where('semester_id', '=', $in_use->semester_id)
                    ->get()->first();


        // if no fee is set, return -1 -> N/A
        $total = 0;
        $tuition_base = 0;
        $miscellaneousFees_base = 0;
        $accommodation_base = 0;
        $result = [];

        // see use department fee or college fee
        $department_id = Auth::user()->department_id;
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
        } else {
            $college_id = DB::table('departments')->where('department_id', '=', $department_id)->get()->first();
            if($college_id->college_id === null) {
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
                } else {
                    $total = -1;
                }
            }
        }

        if($total == -1) {
            return view('student.result', ["errorMsg" => "基數設定錯誤 Fee setting error"]);
        }

        $total = $tuition_base + $miscellaneousFees_base + $accommodation_base;
        $total *= 1.0;

        if($applicant->reduce_tuition_percentage != "101") {
            // echo "Here1";
            $total -= $tuition_base * (1.0 * $applicant->reduce_tuition_percentage / 100);
            $result['tuition_reduce'] = $tuition_base * (1.0 * $applicant->reduce_tuition_percentage / 100);
        } else {
            // echo "Here2";
            $total -= $applicant->reduce_tuition_amount;
            $result['tuition_reduce'] = $applicant->reduce_tuition_amount;
        }

        if($applicant->reduce_miscellaneousFees_percentage != "101") {
            $total -= $miscellaneousFees_base * (1.0 * $applicant->reduce_miscellaneousFees_percentage / 100);
            $result['miscellaneousFees_reduce'] = $miscellaneousFees_base * (1.0 * $applicant->reduce_miscellaneousFees_percentage / 100);
        } else {
            $total -= $applicant->reduce_miscellaneousFees_amount;
            $result['miscellaneousFees_reduce'] = $applicant->reduce_miscellaneousFees_amount;
        }


        if($applicant->reduce_accommodation_percentage != "101") {
            $total -= $accommodation_base * (1.0 * $applicant->reduce_accommodation_percentage / 100);
            $result['accommodation_reduce'] = $accommodation_base * (1.0 * $applicant->reduce_accommodation_percentage / 100);
        } else {
            $total -= $applicant->reduce_accommodation_amount;
            $result['accommodation_reduce'] = $applicant->reduce_accommodation_amount;
        }

        $result['living_reduce'] = $applicant->livingExpense_amount;
        $result['total'] = $total;

        // dd($result);

        return view('student.result', ["result" => $result,]);
    }
}
