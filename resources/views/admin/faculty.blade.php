@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">設定系所所屬院所</h3>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="col-md-4">設定系所所屬院所</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($departments as $department)
                                        <tr>
                                            <td>
                                                <form class="form-inline" method="POST"
                                                      action="{{ url('administrator/facultyManagement/setCollege') }} ">
                                                    {{ csrf_field() }}

                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <div class="form-group">
                                                                <label for="under_college">{{$department->chinese_name}}</label>
                                                                <select id="under_college" class="form-control"
                                                                        name="under_college">
                                                                    @if($department->college_id === null)
                                                                        <option value="-1" selected>請選一個學院</option>
                                                                    @endif
                                                                    @foreach($colleges as $college)
                                                                        <option value="{{$college->college_id}}" {{$department->college_id !== null && $department->college_id == $college->college_id ? "selected" : ""}}>{{$college->chinese_name}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-success"
                                                                        name="department_id"
                                                                        value="{{$department->department_id}}">送出
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection