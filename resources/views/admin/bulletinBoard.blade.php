@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="text-center">所有公告</h1>
        <table class="table table-condensed">
            <thead>
            <tr>
                <th>公告時間</th>
                <th>標題</th>
                <th>內文</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($announcements as $announcement)
                <tr>
                    <td>{{$announcement->timestamp}}</td>
                    <td>{{$announcement->title}}</td>
                    <td>{{$announcement->body}}</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm">編輯</button>
                        <button type="button" class="btn btn-danger btn-sm">刪除</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
