@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
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
                    @foreach($posts as $post)
                    <tr>
                        <td>{{$post->timestamp()}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->content}}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm">編輯</button>
                            <button type="button" class="btn btn-danger btn-sm">刪除</button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

                <hr>

                <h1 class="text-center">新增公告</h1>


                <form class="form-horizontal" method="POST" action="">
                    <div class="form-group">
                        <label for="postTitle">請輸入公告標題</label>
                        <input type="text" id="postTitle" class="form-control" placeholder="Text input">
                    </div>
                    <div class="form-group">
                        <label for="postContent">請輸入公告內文</label>
                        <textarea class="form-control" id="postContent" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">送出</button>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection
