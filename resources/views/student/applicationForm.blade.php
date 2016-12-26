@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
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
                                                    <label>
                                                        <input type="radio" name="sex" id="optionsRadios1" value="2"
                                                               @if(isset($show) && $show->sex == 2)checked @endif>
                                                        其他 Other
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
                                                <input type="number" class="form-control" id="Input Phone No" name="phone_num"
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
                                        <input type="text" class="form-control" id="Input E-mail" name="email"
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
                                        <label for="exampleInputFile">成績單 Transcript</label>
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
                                        <label for="exampleInputFile">其他輔助文件，例如推薦書、研究成果等等<br>Supporting documents, such as supervisors'
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
                            <h3 class="panel-title">附件一</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    附件一
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">附件二</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    附件二
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
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

@endsection