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
                    <td>It's hashed! Hehe!</td>
                    <td>{{$user->email}}</td>
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
