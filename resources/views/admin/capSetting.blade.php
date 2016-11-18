@extends('layouts.app')

@section('content')
    <div class="container theme-showcase" role="main">
        <div class="page-header">
            <h1>基數</h1>
        </div>
        <div class="col-md-6">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>系/院</th>
                    <th>學費</th>
                    <th>雜費</th>
                    <th>住宿</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <select class="form-control" id="assignmentDeadlineMinute" name="assignmentDeadlineMinute">
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
                    </td>
                    <td><input type="text" class="form-control" id="email" placeholder="請輸入基數金額(元）"></td>
                    <td><input type="text" class="form-control" id="email" placeholder="請輸入基數金額(元）"></td>
                    <td><input type="text" class="form-control" id="email" placeholder="請輸入基數金額(元）"></td>
                    <td>
                        <button type="button" class="btn btn-lg btn-primary">確認</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- </div> -->

        <!-- </div> -->
        <br>
        <br>
        <br>
        <br>
        <div class="page-header">
            <h1>上限</h1>
        </div>
        <div class="col-md-6">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>系/院</th>
                    <th>學費</th>
                    <th>雜費</th>
                    <th>生活費</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <select class="form-control" id="assignmentDeadlineMinute" name="assignmentDeadlineMinute">
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
                    </td>
                    <td><input type="text" class="form-control" id="email" placeholder="請輸入上限金額(元）"></td>
                    <td><input type="text" class="form-control" id="email" placeholder="請輸入上限金額(元）"></td>
                    <td><input type="text" class="form-control" id="email" placeholder="請輸入上限金額(元）"></td>
                    <td>
                        <button type="button" class="btn btn-lg btn-primary">確認</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
