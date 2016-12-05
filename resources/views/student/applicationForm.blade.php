@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form class="form-horizontal" method="POST" action={{url('student/applicationForm')}}>
                    {{ csrf_field() }}
                    <div class="form-group">
                        @if(isset($show) && $show->status == 1)
                        <div class="alert alert-success"><strong>您已送出本申請案</strong></div>
                        @elseif(isset($show) && $show->status == 0)
                        <div class="alert alert-warning"><strong>目前為暫存狀態，點按送出才是正式提交</strong>
                            <button type="submit" class="btn btn-xs btn-success pull-right" name="status" value="1">送出</button>
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="Identity">身份</label>
                        <div class="radio" id="Identity">
                            <label>
                                <input type="radio" name="Identity" id="optionsRadios1" value="0" @if((isset($show->Identity) && $show->Identity == 0)||!isset($show))checked @endif>
                                學士班
                            </label>
                            <label>
                                <input type="radio" name="Identity" id="optionsRadios2" value="1" @if(isset($show) && $show->Identity == 1)checked @endif>
                                碩士班
                            </label>
                            <label>
                                <input type="radio" name="Identity" id="optionsRadios3" value="2" @if(isset($show) && $show->Identity == 2)checked @endif>
                                博士班
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Input Chinese Name">中文名字</label>
                        <input type="text" class="form-control" name="Chinese_name" id="Input Chinese Name" placeholder="Chinese Name" value="@if(isset($show)){{($show->Chinese_name)}}@endif">
                    </div>
                    <div class="form-group">
                        <label for="Input English Name">英文名字</label>
                        <input type="text" class="form-control" name="English_name" id="Input English Name " placeholder="English Name" value="@if(isset($show)){{($show->English_name)}}@endif">
                    </div>
                    <div class="form-group">
                        <label for="Input Student ID No">學號</label>
                        <input type="number" class="form-control" name="student_ID" id="Input Student ID No" placeholder="Student ID No" value="@if(isset($show)){{($show->student_id)}}@endif">
                    </div>

                    <div class="form-group">

                        <label for="Department">系所</label>
                        <select id="Department" class="form-control" name="Department">
                            <option value="1" @if(isset($show) && $show->department_id == 1)selected="selected" @endif>文學院</option>
                            <option value="2" @if(isset($show) && $show->department_id == 2)selected="selected" @endif>理學院</option>
                            <option value="3" @if(isset($show) && $show->department_id == 3)selected="selected" @endif>社會科學院</option>
                            <option value="4" @if(isset($show) && $show->department_id == 4)selected="selected" @endif>工學院</option>
                            <option value="5" @if((isset($show) && $show->department_id == 5)||!isset($show))selected="selected" @endif>管理學院</option>
                            <option value="6" @if(isset($show) && $show->department_id == 6)selected="selected" @endif>法學院</option>
                            <option value="7" @if(isset($show) && $show->department_id == 7)selected="selected" @endif>教育學院</option>
                            <option value="8" @if(isset($show) && $show->department_id == 8)selected="selected" @endif>中國文學系</option>
                            <option value="9" @if(isset($show) && $show->department_id == 9)selected="selected" @endif>外國語文學系</option>
                            <option value="10" @if(isset($show) && $show->department_id == 10)selected="selected" @endif>歷史學系</option>
                            <option value="11" @if(isset($show) && $show->department_id == 11)selected="selected" @endif>哲學系</option>
                            <option value="12" @if(isset($show) && $show->department_id == 12)selected="selected" @endif>數學系</option>
                            <option value="13" @if(isset($show) && $show->department_id == 13)selected="selected" @endif>地球與環境科學系</option>
                            <option value="14" @if(isset($show) && $show->department_id == 14)selected="selected" @endif>物理學系</option>
                            <option value="15" @if(isset($show) && $show->department_id == 15)selected="selected" @endif>化學暨生物化學系</option>
                            <option value="16" @if(isset($show) && $show->department_id == 16)selected="selected" @endif>生命科學系</option>
                            <option value="17" @if(isset($show) && $show->department_id == 17)selected="selected" @endif>社會福利學系</option>
                            <option value="18" @if(isset($show) && $show->department_id == 18)selected="selected" @endif>心理學系</option>
                            <option value="19" @if(isset($show) && $show->department_id == 19)selected="selected" @endif>勞工關係學系</option>
                            <option value="20" @if(isset($show) && $show->department_id == 20)selected="selected" @endif>政治學系</option>
                            <option value="21" @if(isset($show) && $show->department_id == 21)selected="selected" @endif>傳播學系</option>
                            <option value="22" @if(isset($show) && $show->department_id == 22)selected="selected" @endif>資訊工程學系</option>
                            <option value="23" @if(isset($show) && $show->department_id == 23)selected="selected" @endif>電機工程學系</option>
                            <option value="24" @if(isset($show) && $show->department_id == 24)selected="selected" @endif>機械工程學系</option>
                            <option value="25" @if(isset($show) && $show->department_id == 25)selected="selected" @endif>化學工程學系</option>
                            <option value="26" @if(isset($show) && $show->department_id == 26)selected="selected" @endif>通訊工程學系</option>
                            <option value="27" @if(isset($show) && $show->department_id == 27)selected="selected" @endif>經濟學系</option>
                            <option value="28" @if(isset($show) && $show->department_id == 28)selected="selected" @endif>財務金融學系</option>
                            <option value="29" @if(isset($show) && $show->department_id == 29)selected="selected" @endif>企業管理學系</option>
                            <option value="30" @if(isset($show) && $show->department_id == 30)selected="selected" @endif>會計與資訊科技學系</option>
                            <option value="31" @if(isset($show) && $show->department_id == 31)selected="selected" @endif>資訊管理學系</option>
                            <option value="32" @if(isset($show) && $show->department_id == 32)selected="selected" @endif>法律學系</option>
                            <option value="33" @if(isset($show) && $show->department_id == 33)selected="selected" @endif>財經法律學系</option>
                            <option value="34" @if(isset($show) && $show->department_id == 34)selected="selected" @endif>成人及繼續教育學系</option>
                            <option value="35" @if(isset($show) && $show->department_id == 35)selected="selected" @endif>犯罪防治學系</option>
                            <option value="36" @if(isset($show) && $show->department_id == 36)selected="selected" @endif>運動競技學系</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Input Nationality">國籍</label>
                        <input type="text" class="form-control" id="Input Nationality" name="Nationality" value="@if(isset($show)){{($show->Nationality)}}@endif" placeholder="Nationality">
                    </div>

                    <div class="form-group">
                        <label for="Sex">性別</label>
                        <div class="radio" id="Sex">
                            <label>
                                <input type="radio" name="sex" id="optionsRadios1" value="0" @if((isset($show) && $show->Sex == 0)||!isset($show))checked @endif>
                                男生
                            </label>
                            <label>
                                <input type="radio" name="sex" id="optionsRadios1" value="1" @if(isset($show) && $show->Sex == 1)checked @endif>
                                女生
                            </label>
                            <label>
                                <input type="radio" name="sex" id="optionsRadios1" value="2" @if(isset($show) && $show->Sex == 2)checked @endif>
                                其他
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Input Passport No">護照號碼</label>
                        <input type="number" class="form-control" id="Input Passport No" name="Passport_num" value="@if(isset($show)){{($show->Passport_number)}}@endif" placeholder="Passport No">
                    </div>


                    <div class="form-group">
                        <label for="Input ARC No">居留證號碼</label>
                        <input type="number" class="form-control" id="Input  ARC No" name="ARC_num" value="@if(isset($show)){{($show->ARC_number)}}@endif" placeholder=" ARC No" >
                    </div>

                    <div class="form-group">
                        <label for="Input Phone No">聯絡電話</label>
                        <input type="number" class="form-control" id="Input Phone No" name="phone_num" value="@if(isset($show)){{($show->Phone_number)}}@endif" placeholder="Phone No">
                    </div>

                    <div class="form-group">
                        <label for="Input Date of Birth">生日</label>
                        <input type="date" class="form-control" id="Date of Birth" name="birthday" value="@if(isset($show)){{($show->Birthday)}}@endif" placeholder="Date of Birth">
                    </div>

                    <div class="form-group">
                        <label for="Input Current Address">通訊地址</label>
                        <input type="text" class="form-control" name="address" value="@if(isset($show)){{($show->Address)}}@endif" id="Input Current Address"
                               placeholder="Current Address">
                    </div>


                    <div class="form-group">
                        <label for="Input E-mail">E-mail</label>
                        <input type="text" class="form-control" id="Input E-mail" name="email" value="@if(isset($show)){{($show->Email)}}@endif" placeholder="E-mail">
                    </div>

                    <div class="form-group">
                        <label for="PastScholarship">是否接受過其他獎學金? (Have you ever received other scholarship(s)</label>
                        <div class="radio" id="PastScholarship">
                            <label>
                                <input type="radio" name="PastScholarship" id="optionsRadios1" value="0" @if((isset($show) && $show->PastScholarship == 0)||!isset($show))checked @endif>
                                否
                            </label>
                            <label>
                                <input type="radio" name="PastScholarship" id="optionsRadios1" value="1" @if(isset($show) && $show->PastScholarship == 1)checked @endif>
                                是
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Input How long">如果有，請問有多久？</label>
                        <input type="text" class="form-control" name='how_long' id="Input How long" value="@if(isset($show)){{($show->How_long)}}@endif" placeholder="How long">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">成績單</label>
                        <input type="file" id="exampleInputFile">
                        <p class="help-block">僅接受pdf檔案</p>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">其他輔助文件</label>
                        <input type="file" id="exampleInputFile">
                        <p class="help-block">僅接受pdf檔案</p>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-warning" name="status" value="0">暫存</button>
                        <button type="submit" class="btn btn-success" name="status" value="1">送出</button>
                        <br><br>
                        <div class="alert alert-success"><strong>截止前您都可以更改</strong></div>
                    </div>

                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

@endsection