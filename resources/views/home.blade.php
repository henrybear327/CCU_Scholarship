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
