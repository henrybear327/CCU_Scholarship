@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form class="col-xs-3" role="form">
                <div class="form-group">
                    <label for="Input Chinese Name">中文名字</label>
                    <input type="text" class="form-control" id="Input Chinese Name" placeholder="Chinese Name">
                </div>
            </form>
            <form class="col-xs-3" role="form">
                <div class="form-group">
                    <label for="Input English Name">英文名字</label>
                    <input type="text" class="form-control" id="Input English Name " placeholder="English Name">
                </div>
            </form>
        </div>
        <div class="row">
            <form class="col-xs-3" role="form">
                <div class="form-group">
                    <label for="Input Student ID No">學號</label>
                    <input type="number" class="form-control" id="Input Student ID No" placeholder="Student ID No">
                </div>
            </form>
            <form class="col-xs-3" role="form">
                <div class="form-group">
                    <label for="Input Department ">系所</label>
                    <input type="text" class="form-control" id="Input Department " placeholder="Department">
                </div>
            </form>
        </div>
        <form class="form-inline" role="form">
            <label for="Input  sex">性別</label>
            <label class="radio-inline">
                <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 男
            </label>
            <label class="radio-inline">
                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 女
            </label>
            <form class="col-xs-3" role="form">
                <div class="form-group">
                    <label for="Input Date of Birth">生日</label>
                    <input type="date" class="form-control" id="Date of Birth" placeholder="Date of Birth">
                </div>
            </form>
        </form>
        <div class="row">
            <form class="col-xs-3" role="form">
                <div class="form-group">
                    <label for="Input Phone No">聯絡電話</label>
                    <input type="number" class="form-control" id="Input Phone No" placeholder="Phone No">
                </div>
            </form>
            <form class="col-xs-3" role="form">
                <div class="form-group">
                    <label for="Input Nationality">國籍</label>
                    <input type="text" class="form-control" id="Input Nationality" placeholder="Nationality">
                </div>
            </form>
        </div>
        <div class="row">
            <form class="col-xs-3" role="form">
                <div class="form-group">
                    <label for="Input Passport No">護照號碼</label>
                    <input type="number" class="form-control" id="Input Passport No" placeholder="Passport No">
                </div>
            </form>
            <form class="col-xs-3" role="form">
                <div class="form-group">
                    <label for="Input ARC No">居留證號碼</label>
                    <input type="number" class="form-control" id="Input  ARC No" placeholder=" ARC No">
                </div>
            </form>
        </div>
        <div class="row">
            <form class="col-xs-3" role="form">
                <div class="form-group">
                    <label for="Input Current Address">通訊地址</label>
                    <input type="text" class="form-control" id="Input Current Address" placeholder="Current Address">
                </div>
            </form>
            <form class="col-xs-3" role="form">
                <div class="form-group">
                    <label for="Input E-mail">E-mail</label>
                    <input type="text" class="form-control" id="Input E-mail" placeholder="E-mail">
                </div>
            </form>
        </div>

        <form class="form-inline" role="form">
            <label for="Input  yes_no">是否接受過其他獎學金?(Have you ever received other scholarship(s)</label><br>
            <label class="radio-inline">
                <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 否
            </label>
            <label class="radio-inline">
                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 是
            </label>
            <div class="form-group">
                <label for="Input How long">多久</label>
                <input type="text" class="form-control" id="Input How long" placeholder="How long">
            </div>
        </form>
        <button type="submit" class="btn btn-default">確定送出</button>
    </div>

@endsection