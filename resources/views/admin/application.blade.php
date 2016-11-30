@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>管理員審查介面</h2>

                <!-- @foreach($applicants as $applicant)
                    {{$applicant->name}}
                    {{$applicant->reduce_tuition_percentage}}
                    {{$applicant->reduce_tuition_amount}}
                    {{$applicant->reduce_miscellaneousFees_percentage}}
                    {{$applicant->reduce_miscellaneousFees_amount}}
                    {{$applicant->reduce_accommodation_percentage}}
                    {{$applicant->reduce_accommodation_amount}}
                    {{$applicant->livingExpense_amount}}
                @endforeach -->

                <form class="form-horizontal" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>學生資料</th>
                            <th>學費減免</th>
                            <th>雜費減免</th>
                            <th>住宿減免</th>
                            <th>生活費補助</th>
                            <th>應繳金額</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($applicants as $applicant)
                            <tr>
                                <td><!-- Trigger the modal with a button -->
                                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                            data-target="#myModal"> {{$applicant->name}}
                                    </button>
                                </td>

                                <td>
                                    <select class="form-control" id="fee1" name="assignmentDeadlineMinute"
                                            onChange='selectOnChange(this);'>
                                        @for ($i = 1; $i <= 100; $i = $i + 1)
                                            @if ($applicant->reduce_tuition_percentage == $i)
                                                <option value="{{$i}}" selected="selected">{{$i}} %</option>";
                                            @else
                                                <option value="{{$i}}">{{$i}} %</option>
                                            @endif
                                        @endfor
                                        <option value="{{$i}}">其他（請輸入欲減免金額(元）</option>
                                        ";
                                    </select>
                                    <input type="number" class="form-control optional_input" id="fee1_optional_input" value='{{$applicant->reduce_tuition_amount}}'>
                                </td>

                                <td>
                                    <select class="form-control" id="fee2" name="assignmentDeadlineMinute"
                                            onChange='selectOnChange(this);'>
                                        @for ($i = 1; $i <= 100; $i = $i + 1)
                                            @if ($applicant->reduce_accommodation_percentage == $i)
                                                <option value="{{$i}}" selected="selected">{{$i}} %</option>";
                                            @else
                                                <option value="{{$i}}">{{$i}} %</option>
                                            @endif
                                        @endfor
                                        <option value="{{$i}}">其他（請輸入欲減免金額(元）</option>
                                        ";
                                    </select>
                                    <input type="number" class="form-control optional_input" id="fee2_optional_input" value='{{$applicant->reduce_miscellaneousFees_amount}}'>
                                </td>

                                <td>
                                    <select class="form-control" id="fee3" name="assignmentDeadlineMinute"
                                            onChange='selectOnChange(this);'>
                                        @for ($i = 1; $i <= 100; $i = $i + 1)
                                            @if ($applicant->reduce_accommodation_percentage == $i)
                                                <option value="{{$i}}" selected="selected">{{$i}} %</option>";
                                            @else
                                                <option value="{{$i}}">{{$i}} %</option>
                                            @endif
                                        @endfor
                                        <option value="{{$i}}">其他（請輸入欲減免金額(元）</option>
                                        ";
                                    </select>
                                    <input type="number" class="form-control optional_input" id="fee3_optional_input" value='{{$applicant->reduce_accommodation_amount}}'>
                                </td>

                                <td>
                                    <input type="number" class="form-control" id="fee4" value='{{$applicant->livingExpense_amount}}'>
                                </td>

                                <td>
                                    1000元
                                </td>

                                <td>
                                    <button type="submit" class="btn btn-success" value="1" name="assignmentSubmission">
                                        確認
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">學生資料</h4>
                </div>
                <div class="modal-body">
                    <p>WOW!</p>
                    學號<br>
                    系級<br>
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                </div>
            </div>

        </div>
    </div>


    <script>

        $(function () {
            $('.optional_input').hide();
        });

        function selectOnChange(sel) {
            if (sel.selectedIndex == 100) {
                $('#' + sel.id).siblings('.optional_input').show();
            }
            else {
                $('#' + sel.id).siblings('.optional_input').hide();
            }
        }

    </script>

@endsection
