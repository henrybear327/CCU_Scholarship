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
                        <h3 class="panel-title">進度</h3>
                    </div>
                    <div class="panel-body">
                        大家辛苦了！大家的作品都很棒，我基本上都有trace過code，有些格式跑掉導致merge conflict或是動到database migration造成的錯誤我都已經修復。<br><br>

                        目前進度
                        <ul>
                            <li>審查介面已經完成。UI有點小bug需要修理，然後資料欄位等待學生申請表實作完畢後，才能開始撈(其實已經差不多了)</li>
                            <li>帳號管理部分我正在看code，我希望讓大家的code都留下來，所以我正在努力merge</li>
                            <li>金額上限設定目前完整了，可以玩(修改的話目前採用的是選取要改的系所直接打直打上去後按確認）</li>
                            <li>公佈欄已經完成。只是我打算UI部分要用Modal來避免長長的公告內文爆了頁面。</li>
                            <li>系統狀態設定未開工，最後弄</li>
                            <li>學生申請表基本功能已經完成，可以存了，但是審查介面還沒能正確撈取</li>
                        </ul>

                        所有提及UI的部分，priority都是最低，先把功能顧好即可，其餘再說。<br>
                        系所與院所的database table需要修正，不能寫死，這我會處理。<br>

                        再次謝謝大家的努力，大家辛苦了。
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
