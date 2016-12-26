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
                        <th class="col-md-2">公告時間</th>
                        <th class="col-md-4">標題</th>
                        <th class="col-md-4">內文</th>
                        <th class="col-md-2">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{$post->created_at}}</td>
                        <td>{{$post->title}}</td>
                        <td>{!! $post->content !!}</td>
                        <td>
                            <a href="{{ url('administrator/bulletinBoard/edit/') }}/{{$post->post_id}}" class="btn btn-primary">編輯</a>
                            <a href="{{ url('administrator/bulletinBoard/delete/') }}/{{$post->post_id}}" class="btn btn-danger">刪除</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

                <hr>

                <h1 class="text-center">新增公告</h1>

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="form-horizontal" method="POST" action="{{ url('administrator/bulletinBoard') }} ">
                    {{ csrf_field() }}
                    <input type="hidden" name="post_id" value="{{$toEditPost->post_id or "-1"}}">
                    <div class="form-group">
                        <label for="postTitle">請輸入公告標題</label>
                        <input type="text" id="postTitle" class="form-control" name="title" placeholder="請輸入標題"
                        value="{{ $toEditPost->title or "" }}">
                    </div>
                    <div class="form-group">
                        <label for="postContent">請輸入公告內文</label>
                        <textarea class="form-control" id="postContent" name="content" rows="3"
                                  placeholder="請輸入公告內文">{{ $toEditPost->content or "" }}</textarea>
                        <script>
                            CKEDITOR.replace( 'content' );
                        </script>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success" name="submitType"
                                value="{{ isset($toEditPost) ? 2 : 1 }}">送出</button>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection
