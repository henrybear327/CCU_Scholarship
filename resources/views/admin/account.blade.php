@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="text-center">帳號管理</h1>
        <table class="table table-condensed">
            <thead>
            <tr>
                <th>Name</th>
                <th>User Type</th>
                <th>ID Number</th>
                <th>Password</th>
                <th>E-mail</th>
                <th>Operations</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>
                        @if($user->user_type == 1)
                            Student
                        @elseif($user->user_type == 2)
                            Reviewer
                        @else
                            Admin
                        @endif
                    </td>
                    <td>Not available</td>
                    {{--<td>It's hashed! Hehe!</td>--}}
                    <td>{{$user->password}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <a href="{{ url('administrator/accountManagement/edit/') }}/{{$user->id}}" class="btn btn-primary">編輯</a>
                        <a href="{{ url('administrator/accountManagement/delete/') }}/{{$user->id}}" class="btn btn-danger">刪除</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <form class="form-horizontal" method="POST" action="{{ url('administrator/accountManagement') }} ">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$toEditAccount->id or "-1"}}">
            <div class="form-group">
                <label for="name">請輸入名字</label>
                <input type="text" id="name" class="form-control" name="name" placeholder="請輸入名字"
                value="{{ $toEditAccount->name or "" }}">
            </div>
            <div class="form-group">
                <label for="email">請輸入email</label>
                <input type="text" id="email" class="form-control" name="email" placeholder="請輸入email"
                value="{{$toEditAccount->email or ""}}">
            </div>
            <div class="form-group">
                <label for="password">請輸入密碼</label>
                <input type="text" id="password" class="form-control" name="password" placeholder="請輸入password"
                value="{{$toEditAccount->password or ""}}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success" name="submitType"
                        value="{{ isset($toEditAccount) ? 2 : 1 }}">送出</button>
            </div>
        </form>
    </div>
@endsection
