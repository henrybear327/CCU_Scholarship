@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">申請時間設定</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <form class="form-horizontal" method="POST"
                                      action="{{ url('administrator/systemStatus/setSemester') }} ">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="currentSemester">目前學期</label>
                                        <select id="currentSemester" class="form-control" name="semester_id">
                                            @if(isset($in_use) == false)
                                                <option value="-1" selected>請選一個學期</option>
                                            @endif
                                            @foreach($semesters as $semester)
                                                <option value="{{$semester->semester_id}}" {{isset($in_use) && $semester->semester_id == $in_use->semester_id ? "selected" : ""}}>{{$semester->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" name="submitType"
                                                value="1">使用此學期
                                        </button>
                                    </div>
                                </form>

                                <hr>

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form class="form-horizontal" method="POST" enctype="multipart/form-data"
                                      action="{{ url('administrator/systemStatus/setTimeline') }} ">
                                    <h1 class="text-center">申請時程</h1>

                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="start_apply_date">開放申請</label>
                                        <input class="form-control"  type="date" id="start_apply_date" name="start_apply_date" value="{{$in_use->start_apply_date or ""}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="end_apply_date">結束申請</label>
                                        <input class="form-control" type="date" id="end_apply_date" name="end_apply_date" value="{{$in_use->end_apply_date or ""}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="start_review_date">開放審查</label>
                                        <input class="form-control"  type="date" id="start_review_date" name="start_review_date" value="{{$in_use->start_review_date or ""}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="end_review_date">結束審查</label>
                                        <input class="form-control"  type="date" id="end_review_date" name="end_review_date" value="{{$in_use->end_review_date or ""}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="start_show_result_date">開放結果</label>
                                        <input class="form-control"  type="date" id="start_show_result_date" name="start_show_result_date" value="{{$in_use->start_show_result_date or ""}}">
                                    </div>

                                    <h1 class="text-center">審查人員設定</h1>

                                    <div class="form-group">
                                        <label for="reviewByCollege">審查人員</label>
                                        <select class="form-control" id="reviewByCollege" name="reviewByCollege">
                                            <option value="1" {{isset($in_use->reviewByCollege) && $in_use->reviewByCollege == 1 ? "selected" : ""}}>院所審查</option>
                                            <option value="0" {{isset($in_use->reviewByCollege) && $in_use->reviewByCollege == 0 ? "selected" : ""}}>系所審查</option>
                                        </select>
                                    </div>

                                    <h1 class="text-center">連結設定</h1>

                                    <div class="form-group">
                                        <label for="ruleURL">申請規章連結</label>
                                        <input class="form-control" id="ruleURL" type="text" name="ruleURL" value="{{$in_use->ruleURL or ""}}">
                                        <p class="help-block">請使用 http:// 或 https:// 開頭</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="attachment1">附件一</label>
                                        <input class="form-control" id="attachment1" type="file" name="attachment1">

                                        @if(isset($attachment1_url) == true)
                                            <div class="alert alert-success" role="alert"><a href="{{$attachment1_url}}">附件一</a></div>
                                        @else
                                            <div class="alert alert-danger" role="alert">您還未上傳附件一！</div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" name="submitType" value="1"> 儲存設定
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">學期操作</h3>
                    </div>
                    <div class="panel-body">
                        <h1 class="text-center">學期資料</h1>
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th class="col-md-3">年份</th>
                                <th class="col-md-3">學期</th>
                                <th class="col-md-3">學期名稱</th>
                                <th class="col-md-3">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($semesters as $semester)
                                <tr>
                                    <td>{{$semester->year}}</td>
                                    <td>{{$semester->term}}</td>
                                    <td>{{$semester->name}}</td>
                                    <td>
                                        <a href="{{ url('administrator/statusSetting/editSemester/') }}/{{$semester->semester_id}}"
                                           class="btn btn-primary">編輯</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <hr>

                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <h1 class="text-center">新增學期</h1>

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form class="form-horizontal" method="POST"
                                      action="{{ url('administrator/systemStatus/semester') }} ">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="semester_id"
                                           value="{{$toEditSemester->semester_id or "-1"}}">
                                    <div class="form-group">
                                        <label for="year">年份</label>
                                        <input type="number" id="year" class="form-control" name="year"
                                               placeholder="e.g. 2017"
                                               value="{{ $toEditSemester->year or "" }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="term">學期</label>
                                        <div class="radio" id="term">
                                            <label>
                                                <input type="radio" name="term" id="term" value="1"
                                                       @if((isset($toEditSemester->term) && $toEditSemester->term == 1)
                                                       || !isset($toEditSemester)) checked @endif>
                                                第一學期
                                            </label>
                                            <label>
                                                <input type="radio" name="term" id="term" value="2"
                                                       @if(isset($toEditSemester->term) && $toEditSemester->term == 2)checked @endif>
                                                第二學期
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">學期名稱</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="請自訂學期名稱 e.g. 2017 秋季班"
                                               value="{{ $toEditSemester->name or "" }}">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" name="submitType"
                                                value="{{ isset($toEditSemester) ? 2 : 1 }}">送出
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection