@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="text-center">帳號管理</h1>
        <table class="table table-condensed">
            <thead>
            <tr>
                <th>名字</th>
                <th>身份別</th>
                <th>帳號</th>
                <th>密碼</th>
                <th>學生證號碼</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>
                        @if($user->user_type == 1)
                            學生
                        @elseif($user->user_type == 2)
                            審查人員
                        @else
                            管理員
                        @endif
                    </td>
                    <td>{{$user->email}}</td>
                    <td>
                        @if($user->user_type == 2)
                            預設為 default
                        @else
                            無法取得
                        @endif
                    </td>
                    <td>{{$user->student_id or "N/A"}}</td>
                    <td>
                        <a href="{{ url('administrator/accountManagement/edit/') }}/{{$user->id}}" class="btn btn-primary">編輯</a>
                        <!--<a href="{{ url('administrator/accountManagement/delete/') }}/{{$user->id}}" class="btn btn-danger">刪除</a>-->
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="form-group">
        <div class="container">
        <!-- <a href= "{{url('administrator/accountManagement/createAccount')}}" class="btn btn-success" >新增帳號</a> -->
        <a href= "{{url('administrator/accountManagement/createAccountForFaculties')}}" class="btn btn-success" >為所有系院創立帳號</a>
    </div>
    </div>
@endsection
