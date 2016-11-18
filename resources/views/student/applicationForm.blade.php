@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form class="form-horizontal" method="POST" action="">
                    <div class="form-group">
                        <label for="Identity">身份</label>
                        <div class="radio" id="Identity">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                學士班
                            </label>
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                                碩士班
                            </label>
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                                博士班
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Input Chinese Name">中文名字</label>
                        <input type="text" class="form-control" id="Input Chinese Name" placeholder="Chinese Name">
                    </div>
                    <div class="form-group">
                        <label for="Input English Name">英文名字</label>
                        <input type="text" class="form-control" id="Input English Name " placeholder="English Name">
                    </div>
                    <div class="form-group">
                        <label for="Input Student ID No">學號</label>
                        <input type="number" class="form-control" id="Input Student ID No" placeholder="Student ID No">
                    </div>

                    <div class="form-group">
                        <label for="Department">系所</label>
                        <select id="Department" class="form-control">
                            <option value="1">文學院</option>
                            <option value="2">理學院</option>
                            <option value="3">社會科學院</option>
                            <option value="4">工學院</option>
                            <option value="5" selected="selected">管理學院</option>
                            <option value="6">法學院</option>
                            <option value="7">教育學院</option>
                            <option value="8">中國文學系</option>
                            <option value="9">外國語文學系</option>
                            <option value="10">歷史學系</option>
                            <option value="11">哲學系</option>
                            <option value="12">數學系</option>
                            <option value="13">地球與環境科學系</option>
                            <option value="14">物理學系</option>
                            <option value="15">化學暨生物化學系</option>
                            <option value="16">生命科學系</option>
                            <option value="17">社會福利學系</option>
                            <option value="18">心理學系</option>
                            <option value="19">勞工關係學系</option>
                            <option value="20">政治學系</option>
                            <option value="21">傳播學系</option>
                            <option value="22">資訊工程學系</option>
                            <option value="23">電機工程學系</option>
                            <option value="24">機械工程學系</option>
                            <option value="25">化學工程學系</option>
                            <option value="26">通訊工程學系</option>
                            <option value="27">經濟學系</option>
                            <option value="28">財務金融學系</option>
                            <option value="29">企業管理學系</option>
                            <option value="30">會計與資訊科技學系</option>
                            <option value="31">資訊管理學系</option>
                            <option value="32">法律學系</option>
                            <option value="33">財經法律學系</option>
                            <option value="34">成人及繼續教育學系</option>
                            <option value="35">犯罪防治學系</option>
                            <option value="36">運動競技學系</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Input Nationality">國籍</label>
                        <input type="text" class="form-control" id="Input Nationality" placeholder="Nationality">
                    </div>

                    <div class="form-group">
                        <label for="Sex">性別</label>
                        <div class="radio" id="Sex">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                男生
                            </label>
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                                女生
                            </label>
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                                其他
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Input Passport No">護照號碼</label>
                        <input type="number" class="form-control" id="Input Passport No" placeholder="Passport No">
                    </div>


                    <div class="form-group">
                        <label for="Input ARC No">居留證號碼</label>
                        <input type="number" class="form-control" id="Input  ARC No" placeholder=" ARC No">
                    </div>

                    <div class="form-group">
                        <label for="Input Phone No">聯絡電話</label>
                        <input type="number" class="form-control" id="Input Phone No" placeholder="Phone No">
                    </div>

                    <div class="form-group">
                        <label for="Input Date of Birth">生日</label>
                        <input type="date" class="form-control" id="Date of Birth" placeholder="Date of Birth">
                    </div>

                    <div class="form-group">
                        <label for="Input Current Address">通訊地址</label>
                        <input type="text" class="form-control" id="Input Current Address"
                               placeholder="Current Address">
                    </div>


                    <div class="form-group">
                        <label for="Input E-mail">E-mail</label>
                        <input type="text" class="form-control" id="Input E-mail" placeholder="E-mail">
                    </div>

                    <div class="form-group">
                        <label for="PastScholarship">是否接受過其他獎學金? (Have you ever received other scholarship(s)</label>
                        <div class="radio" id="PastScholarship">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                否
                            </label>
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                                是
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Input How long">如果有，請問有多久？</label>
                        <input type="text" class="form-control" id="Input How long" placeholder="How long">
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

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">確定送出（截止前您都可以更改）</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

@endsection