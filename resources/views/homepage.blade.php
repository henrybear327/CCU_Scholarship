@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>中正獎學金系統</h1>

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

                <div class="panel panel-default">
                    <div class="panel-heading">公告 Announcement</div>

                    <div class="panel-body">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th class="col-md-2">公告時間 Time</th>
                                <th class="col-md-5">標題 Title</th>
                                <th class="col-md-5">內文 Content</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{$post->created_at}}</td>
                                <td>{{$post->title}}</td>
                                <td>{!! $post->content !!}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
