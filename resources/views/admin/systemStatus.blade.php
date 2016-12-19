@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
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
                                                上學期
                                            </label>
                                            <label>
                                                <input type="radio" name="term" id="term" value="2"
                                                       @if(isset($toEditSemester->term) && $toEditSemester->term == 2)checked @endif>
                                                下學期
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