@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">控制台</div>

                    <div class="panel-body">
                        You are logged in as
                        @if(Auth::user()->userType == 3) 管理員
                        @elseif(Auth::user()->userType == 2) 審查人員
                        @else 學生
                        @endif!<hr>

                        @if(Auth::user()->userType == 3)
                            <a href="{{ url('/administrator/application') }}">審查介面</a>:可以看到簡單版的申請資料<br>
                            <a href="{{ url('/administrator/accountManagement') }}">帳號管理</a>：可以觀看所有帳號和任意刪除帳號(對，刪除任意帳號）<br>
                            <a href="{{ url('/administrator/capSetting') }}">金額上限設定</a>:沒功能，只有靜態畫面<br>
                            <a href="{{ url('/administrator/statusSetting') }}">系統狀態設定</a>:沒功能，只有靜態畫面<br>
                        @elseif(Auth::user()->userType == 2) reviewer
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
