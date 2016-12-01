@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>中正獎學金系統</h1>

                <div class="panel panel-default">
                    <div class="panel-heading">系統公告</div>

                    <div class="panel-body">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th>公告時間</th>
                                <th>標題</th>
                                <th>內文</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{$post->timestamps()}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->content}}</td>
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
