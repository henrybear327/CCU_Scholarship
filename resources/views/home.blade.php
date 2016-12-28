@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">申請時程 Scholarship Application Schedule</div>

                    <div class="panel-body">
                        <p>最後更新時間 Last updated：{{$in_use->updated_at or ""}}</p>
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th class="col-md-6">項目 Task</th>
                                <th class="col-md-6">日期 Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>申請期間 Application Interval</td>
                                <td>{{$in_use->start_apply_date or ""}} ~ {{$in_use->end_apply_date or ""}}</td>
                            </tr>
                            <tr>
                                <td>審查期間 Reviewing Interval</td>
                                <td>{{$in_use->start_review_date or ""}} ~ {{$in_use->end_review_date or ""}}</td>
                            </tr>
                            <tr>
                                <td>開放查詢結果 Announcement Date</td>
                                <td>{{$in_use->start_show_result_date or ""}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">功能 Features</h3>
                    </div>
                    <div class="panel-body">
                        @if(Auth::user()->user_type == 3)
                            <a href="{{ url('/administrator/application') }}">審查介面</a><br>
                            <a href="{{ url('/administrator/accountManagement') }}">帳號管理</a><br>
                            <a href="{{ url('/administrator/capSetting') }}">金額上限設定</a><br>
                            <a href="{{ url('/administrator/bulletinBoard') }}">公布欄</a><br>

                            <a href="{{ url('/administrator/statusSetting') }}">系統狀態設定</a><br>
                        @elseif(Auth::user()->user_type == 2) reviewer
                        @else
                            <a href="{{ url('/student/applicationForm') }}">學生申請表 Application</a><br>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
