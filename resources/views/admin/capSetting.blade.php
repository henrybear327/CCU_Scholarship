@extends('layouts.app')

@section('content')

    <div class="container theme-showcase" role="main">
        <div class="page-header">
            <h1>基數</h1>

            <table class="table table-condensed">
                <tr>
                    <th class="col-md-2">系/院</th>
                    <th class="col-md-3">學費</th>
                    <th class="col-md-3">雜費</th>
                    <th class="col-md-3">住宿</th>
                    <th class="col-md-3">生活費</th>
                </tr>
                @foreach($fees as $fee)
                    <tr>
                        <td>{{$fee->chinese_name}}</td>
                        <td>{{$fee->tuition_base}}</td>
                        <td>{{$fee->miscellaneousFees_base}}</td>
                        <td>{{$fee->accommodation_base}}</td>
                        <td>{{$fee->cost_of_living_base}}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        <form class="form-horizontal" method="POST" action="{{ url('administrator/capSetting') }} ">
            {{ csrf_field() }}
            <label for="faculty_id">系/院</label>
            <select class="form-control" id="faculty_id" name="faculty_id">
                @foreach($faculties as $faculty)
                    <option value="{{$faculty->department_id or $faculty->college_id}}">{{$faculty->chinese_name}}</option>
                @endforeach
            </select>

            <div class="row">
                <div class="col-md-3">
                    <label for="tuition_base">學費</label>
                    <input type="text" name="tuition_base" class="form-control" id="tuition_base"
                           placeholder="請輸入學費基數金額(元）" required>
                </div>
                <div class="col-md-3">
                    <label for="miscellaneousFees_base">雜費</label>
                    <input type="text" name="miscellaneousFees_base" class="form-control" id="miscellaneousFees_base"
                           placeholder="請輸入雜費基數金額(元）" required>
                </div>
                <div class="col-md-3">
                    <label for="accommodation_base">住宿</label>
                    <input type="text" name="accommodation_base" class="form-control" id="accommodation_base"
                           placeholder="請輸入住宿基數金額(元）" required>
                </div>
                <div class="col-md-3">
                    <label for="cost_of_living_base">生活費</label>
                    <input type="text" name="cost_of_living_base" class="form-control" id="cost_of_living_base"
                           placeholder="請輸入生活費基數金額(元）" required>
                </div>
            </div>

            <button type="submit" class="btn btn-success" name="submitType" value=1>確認</button>
        </form>

        <hr>

        <div class="page-header">
            <h1>上限</h1>

            <table class="table table-condensed">
                <tr>
                    <th class="col-md-2">系/院</th>
                    <th class="col-md-3">學費</th>
                    <th class="col-md-3">雜費</th>
                    <th class="col-md-3">住宿</th>
                    <th class="col-md-3">生活費</th>
                </tr>
                @foreach($caps as $cap)
                    <tr>
                        <td>{{$cap->chinese_name}}</td>
                        <td>{{$cap->tuition_cap}}</td>
                        <td>{{$cap->miscellaneousFees_cap}}</td>
                        <td>{{$cap->accommodation_cap}}</td>
                        <td>{{$cap->cost_of_living_cap}}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        <form class="form-horizontal" method="POST" action="{{ url('administrator/capSetting') }} ">
            {{ csrf_field() }}
            <label for="faculty_id">系/院</label>
            <select class="form-control" id="faculty_id" name="faculty_id">
                @foreach($faculties as $faculty)
                    <option value="{{$faculty->department_id or $faculty->college_id}}">{{$faculty->chinese_name}}</option>
                @endforeach
            </select>

            <div class="row">
                <div class="col-md-3">
                    <label for="tuition_base">學費</label>
                    <input type="text" name="tuition_cap" class="form-control" id="email"
                           placeholder="請輸入上限金額(元）" required>
                </div>
                <div class="col-md-3">
                    <label for="miscellaneousFees_base">雜費</label>
                    <input type="text" name="miscellaneousFees_cap" class="form-control" id="email"
                           placeholder="請輸入上限金額(元）" required>
                </div>
                <div class="col-md-3">
                    <label for="accommodation_base">住宿</label>
                    <input type="text" name="accommodation_cap" class="form-control" id="email"
                           placeholder="請輸入上限金額(元）" required>
                </div>
                <div class="col-md-3">
                    <label for="cost_of_living_base">生活費</label>
                    <input type="text" name="cost_of_living_cap" class="form-control" id="email"
                           placeholder="請輸入上限金額(元）" required>
                </div>
            </div>

            <button type="submit" class="btn btn-success" name="submitType" value=3>確認</button>
        </form>
    </div>
@endsection
