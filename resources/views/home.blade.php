@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">系統訊息</h3>
                    </div>
                    <div class="panel-body">
                        您的目前的身份是
                        @if(Auth::user()->user_type == 3) 管理員
                        @elseif(Auth::user()->user_type == 2) 審查人員
                        @else 學生
                        @endif !
                    </div>
                </div>

                <div class="panel panel-info">
                    <div class="panel-heading">申請時程</div>

                    <div class="panel-body">
                        <p>最後更新時間：{{$in_use->updated_at or ""}}</p>
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th class="col-md-6">項目</th>
                                <th class="col-md-6">日期</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>開放申請</td>
                                <td>{{$in_use->start_apply_date or ""}}</td>
                            </tr>
                            <tr>
                                <td>結束申請</td>
                                <td>{{$in_use->end_apply_date or ""}}</td>
                            </tr>
                            <tr>
                                <td>開始審查</td>
                                <td>{{$in_use->start_review_date or ""}}</td>
                            </tr>
                            <tr>
                                <td>結束審查</td>
                                <td>{{$in_use->end_review_date or ""}}</td>
                            </tr>
                            <tr>
                                <td>開放查詢結果</td>
                                <td>{{$in_use->start_show_result_date or ""}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                @if(Auth::user()->user_type != 1)
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">進度</h3>
                    </div>
                    <div class="panel-body">
                        請使用Chrome!
                    </div>
                </div>
                @endif

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">功能</h3>
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
                            TODO: 做申請文件下載區<br>
                            <a href="{{ url('/student/applicationForm') }}">學生申請表</a><br>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
