@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                @if(Session::has('invalidStudentID'))
                    <div class="alert alert-danger" role="alert">{{Session::get('invalidStudentID')}}</div>
                @endif

                @if(isset($blockForm) == true)
                        <div class="alert alert-danger" role="alert">{{$blockForm}}</div>
                @elseif(isset($noStudentID) == true && $noStudentID == 1)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Student ID</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <form class="form-horizontal" method="POST" action={{url('student/applicationForm/addStudentID')}}>
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label for="student_id">Student ID: </label>
                                            <input class="form-control" id="student_id" type="number" name="student_id">
                                        </div>

                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-success" name="status" value="1">送出 Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                    </div>
                @elseif(isset($needToReadRule) == true)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Policy</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <p>Please read the following document, <a href="{{$needToReadRule}}">National Chung Cheng University
                                            Implementation Policy of the Scholarship Award for International Students</a>, carefully!</p>

                                    <hr>

                                    <form class="form-horizontal" method="POST" action={{url('student/applicationForm/readRule')}}>
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label for="readRule">Declaration</label>
                                            <p>
                                                I have read and understand the "National Chung Cheng University
                                                Implementation Policy of the Scholarship Award for International Students", and I accept and agree
                                                to all of its terms and conditions.
                                            </p>
                                            <input id="readRule" type="checkbox" name="readRule" value="1"> Agree
                                        </div>

                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-success" name="status" value="1">送出 Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                    </div>
                @else
                <form class="form-horizontal" method="POST" enctype="multipart/form-data"
                      action={{url('student/applicationForm')}}>
                    {{ csrf_field() }}

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">基本資料 Basic information</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        @if(Session::has('dateError'))
                                            <div class="alert alert-danger">
                                                {{Session::get('dateError')}}
                                            </div>
                                        @endif

                                        @if(Session::has('resubmission'))
                                            <div class="alert alert-danger">
                                                {{Session::get('resubmission')}}
                                            </div>
                                        @else
                                            @if(isset($show) && $show->status == 1)
                                                <div class="alert alert-success"><strong>您已送出本申請案<br>The application has been
                                                        submitted</strong></div>
                                            @elseif(isset($show) && $show->status == 0)
                                                <div class="alert alert-warning"><strong>目前為暫存狀態，點按送出才是正式提交<br> The draft has been saved.
                                                        Please remember to click the submit button to officially submit the
                                                        application.</strong>
                                                </div>
                                            @endif
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="Identity">身份 Identity</label>
                                        <div class="radio" id="Identity">
                                            <label>
                                                <input type="radio" name="Identity" id="optionsRadios1" value="0"
                                                       @if((isset($show->identity) && $show->identity == 0)||!isset($show))checked @endif>
                                                學士班 Bachelor
                                            </label>
                                            <label>
                                                <input type="radio" name="Identity" id="optionsRadios2" value="1"
                                                       @if(isset($show) && $show->identity == 1)checked @endif>
                                                碩士班 Master
                                            </label>
                                            <label>
                                                <input type="radio" name="Identity" id="optionsRadios3" value="2"
                                                       @if(isset($show) && $show->identity == 2)checked @endif>
                                                博士班 PhD
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Input Chinese Name">中文名字 Chinese Name</label>
                                                <input type="text" class="form-control" name="Chinese_name" id="Input Chinese Name"
                                                       placeholder="Chinese Name" value="@if(isset($show)){{($show->chinese_name)}}@endif">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Input English Name">英文名字 English Name</label>
                                                <input type="text" class="form-control" name="English_name" id="Input English Name "
                                                       placeholder="English Name" value="@if(isset($show)){{($show->english_name)}}@endif">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Input Nationality">國籍 Nationality</label>
                                                <input type="text" class="form-control" id="Input Nationality" name="Nationality"
                                                       value="@if(isset($show)){{($show->nationality)}}@endif" placeholder="Nationality">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Sex">性別 Sex</label>
                                                <div class="radio" id="Sex">
                                                    <label>
                                                        <input type="radio" name="sex" id="optionsRadios1" value="0"
                                                               @if((isset($show) && $show->sex == 0)||!isset($show))checked @endif>
                                                        男生 Male
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="sex" id="optionsRadios1" value="1"
                                                               @if(isset($show) && $show->sex == 1)checked @endif>
                                                        女生 Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Input Passport No">護照號碼 Passport No.</label>
                                                <input type="number" class="form-control" id="Input Passport No" name="Passport_num"
                                                       value="@if(isset($show)){{($show->passport_number)}}@endif" placeholder="Passport No">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Input ARC No">居留證號碼 ARC No.</label>
                                                <input type="number" class="form-control" id="Input  ARC No" name="ARC_num"
                                                       value="@if(isset($show)){{($show->arc_number)}}@endif" placeholder=" ARC No">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Input Phone No">聯絡電話 Phone No.</label>
                                                <input type="text" class="form-control" id="Input Phone No" name="phone_num"
                                                       value="@if(isset($show)){{($show->phone_number)}}@endif" placeholder="Phone No">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Input Date of Birth">生日 Date of Birth</label>
                                                <input type="date" class="form-control" id="Date of Birth" name="birthday"
                                                       value="@if(isset($show)){{($show->birthday)}}@endif" placeholder="Date of Birth">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="Input Current Address">通訊地址 Current Address</label>
                                        <input type="text" class="form-control" name="address"
                                               value="@if(isset($show)){{($show->address)}}@endif" id="Input Current Address"
                                               placeholder="Current Address">
                                    </div>

                                    <div class="form-group">
                                        <label for="Input E-mail">E-mail</label>
                                        <input type="email" class="form-control" id="Input E-mail" name="email"
                                               value="@if(isset($show)){{($show->email)}}@endif" placeholder="E-mail">
                                    </div>

                                    <div class="form-group">
                                        <label for="PastScholarship">是否接受過其他獎學金? <br>Have you ever received other
                                            scholarship(s)?</label>
                                        <div class="radio" id="PastScholarship">
                                            <label>
                                                <input type="radio" name="PastScholarship" id="optionsRadios1" value="0"
                                                       @if((isset($show) && $show->pastScholarship == 0)||!isset($show))checked @endif>
                                                否 (請跳過下一題）<br> No (Please skip the next question)
                                            </label>
                                            <label>
                                                <input type="radio" name="PastScholarship" id="optionsRadios1" value="1"
                                                       @if(isset($show) && $show->pastScholarship == 1)checked @endif>
                                                是 (請回答下一題）<br> Yes (Please answer the next question)
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="Input How long">請問您接受過多久的獎學金？<br> (How long have you been receiving the
                                            scholarship(s)?</label>
                                        <input type="text" class="form-control" name='how_long' id="Input How long"
                                               value="@if(isset($show)){{($show->how_long)}}@endif" placeholder="How long">
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label for="transcript">成績單 Transcript</label>
                                        <input type="file" id="transcript" name="transcript">
                                        <p class="help-block">僅接受pdf檔案 <br> PDF is the only accepted file type</p>

                                        @if(isset($fileUrl['transcript_url']))
                                            <a href="{{$fileUrl['transcript_url']}}">檢視上傳的檔案 View uploaded file</a>
                                        @else
                                            您還未上傳成績單<br> You haven't submitted the transcript yet
                                        @endif
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label for="supportDocument">其他輔助文件，例如推薦書、研究成果等等<br>Supporting documents, such as supervisors'
                                            recommendations, research accomplishments, etc.</label>
                                        <input type="file" id="supportDocument" name="supportDocument">
                                        <p class="help-block">僅接受pdf檔案 <br> PDF is the only accepted file type</p>

                                        @if(isset($fileUrl['supportDocument_url']))
                                            <a href="{{$fileUrl['supportDocument_url']}}">上次上傳的檔案</a>
                                        @else
                                            您還未上傳其他輔助文件<br> You haven't submitted the supporting documents yet
                                        @endif
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label for="declaration">Declaration</label>
                                        <p>I, the undersigned, declare that:<br>
                                            A. I do not have the overseas Chinese status nor hold the Republic of China nationality.
                                            <br>
                                            B. If I formerly held Republic of China nationality, I declare that I have officially given
                                            up my R.O.C. nationality for at least eight years, up until the beginning date of the first
                                            term in which I seek admission on National Chung Cheng University calendar. I also
                                            understand that a false declaration would result in the immediate cancellation of my
                                            admission or the deprivation of my status as a Chung Cheng University registered student.
                                        </p>
                                        <input id="declaration" type="checkbox" name="declaration" value="1"> Agree
                                    </div>

                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">附件一 Attachment 1<br>外國學生華語能力及學習狀況評量表 <br>Evaluation Form of Chinese Language Proficiency and Academic Performance of International Students</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    請下載 <a href="{{$fileUrl['attachment1'] or "http://oia.ccu.edu.tw/ciaeenglish/lawtable.html"}}">附件一</a> ，填寫後掃描成 PDF 檔案後上傳<br><br>
                                    Please download <a href="{{$fileUrl['attachment1'] or "http://oia.ccu.edu.tw/ciaeenglish/lawtable.html"}}">attachment 1</a>. Upon completion, please scan and upload it in PDF format.

                                    <hr>

                                    <div class="form-group">
                                        <label for="attachment1">上傳 Upload</label>
                                        <input class="form-control" id="attachment1" type="file" name="attachment1">

                                        @if(isset($fileUrl['attachment1_url']))
                                            <div class="alert alert-success" role="alert"><a href="{{$fileUrl['attachment1_url']}}">檢視上傳的檔案 View the file your uploaded</a></div>
                                        @else
                                            <div class="alert alert-danger" role="alert">您還未上傳附件一！<br>Attachment 1 not uploaded yet</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">附件二 Attachment 2<br>外國學生華語能力及華語課程修課狀況評量表<br>
                                Evaluation Form of Student’s Chinese Language Proficiency and Chinese Courses Attendance</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    如果您的身份是學士班，系統會自動為您產生附件二並送出。<br>
                                    如果您的身份是碩士班或是博士班，如果您需要系統產生附件二，請在下面的框框中打勾。<br><br>

                                    If your identity is bachelor, attachment 2 will be generated by the system and attached to your application automatically.<br>
                                    If your identity is master or PhD, please check the box below to indicate that you need to the system to generate and submit attachment 2.

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="need_attachment2" value="1" {{isset($show) && $show->need_attachment2 == 1 ? "checked" : ""}}> 需送出附件二 Need attachent 2
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-warning" name="status" value="0">暫存 Save draft</button>
                        <button type="submit" class="btn btn-success" name="status" value="1">送出 Submit application</button>
                    </div>
                </form>
                @endif
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

@endsection