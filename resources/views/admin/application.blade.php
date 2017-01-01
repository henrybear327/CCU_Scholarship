@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>管理員審查介面</h2>

            <!--
                @foreach($applicants as $applicant)
                {{$applicant->name}}
                {{$applicant->reduce_tuition_percentage}}
                {{$applicant->reduce_tuition_amount}}
                {{$applicant->reduce_miscellaneousFees_percentage}}
                {{$applicant->reduce_miscellaneousFees_amount}}
                {{$applicant->reduce_accommodation_percentage}}
                {{$applicant->reduce_accommodation_amount}}
                {{$applicant->livingExpense_amount}}
                @endforeach
            -->


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
                        <form class="form-horizontal" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{$applicant->id or ""}}">
                                <td><!-- Trigger the modal with a button -->
                                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                            data-target="#myModal-{{$applicant->id}}"> {{$applicant->name}}
                                    </button>
                                </td>

                                <td>
                                    <select class="form-control" id="fee1-{{$applicant->id}}" name="fee1"
                                            onChange='selectOnChange(this);'>
                                        @for ($i = 0; $i <= 100; $i = $i + 1)
                                            @if ($applicant->reduce_tuition_percentage == $i)
                                                <option value="{{$i}}" selected="selected">{{$i}} %</option>";
                                            @else
                                                <option value="{{$i}}">{{$i}} %</option>
                                            @endif
                                        @endfor
                                        <option value="{{$i}}">其他（請輸入欲減免金額(元）</option>
                                        ";
                                    </select>
                                    <input type="number" class="form-control optional_input" name="fee1_optional_input"
                                           value='{{$applicant->reduce_tuition_amount}}'>
                                </td>

                                <td>
                                    <select class="form-control" id="fee2-{{$applicant->id}}" name="fee2"
                                            onChange='selectOnChange(this);'>
                                        @for ($i = 0; $i <= 100; $i = $i + 1)
                                            @if ($applicant->reduce_miscellaneousFees_percentage == $i)
                                                <option value="{{$i}}" selected="selected">{{$i}} %</option>";
                                            @else
                                                <option value="{{$i}}">{{$i}} %</option>
                                            @endif
                                        @endfor
                                        <option value="{{$i}}">其他（請輸入欲減免金額(元）</option>
                                        ";
                                    </select>
                                    <input type="number" class="form-control optional_input" name="fee2_optional_input"
                                           value='{{$applicant->reduce_miscellaneousFees_amount}}'>
                                </td>

                                <td>
                                    <select class="form-control" id="fee3-{{$applicant->id}}" name="fee3"
                                            onChange='selectOnChange(this);'>
                                        @for ($i = 0; $i <= 100; $i = $i + 1)
                                            @if ($applicant->reduce_accommodation_percentage == $i)
                                                <option value="{{$i}}" selected="selected">{{$i}} %</option>";
                                            @else
                                                <option value="{{$i}}">{{$i}} %</option>
                                            @endif
                                        @endfor
                                        <option value="{{$i}}">其他（請輸入欲減免金額(元）</option>
                                        ";
                                    </select>
                                    <input type="number" class="form-control optional_input" name="fee3_optional_input"
                                           value='{{$applicant->reduce_accommodation_amount}}'>
                                </td>

                                <td>
                                    <input type="number" class="form-control" name="fee4"
                                           value='{{$applicant->livingExpense_amount}}'>
                                </td>

                                <td>
                                    1000元
                                </td>

                                <td>
                                    <button type="submit" class="btn btn-success" value="1" name="assignmentSubmission">確認</button>
                                </td>
                        </form>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @foreach($applicants as $applicant)
    <div class="modal fade" id="myModal-{{$applicant->id}}" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">學生資料</h4>
                </div>
                <div class="modal-body">
                    <p>身份: {{isset($applicant->identity) == true ? ($applicant->identity == 0 ? "大學部" : ($applicant->identity == 1 ? "碩士班" : "博士班")) : ""}}</p>
                    <p>中文姓名: {{$applicant->chinese_name or ""}}</p>
                    <p>英文姓名: {{$applicant->english_name or ""}}</p>
                    <p>國籍: {{$applicant->nationality or ""}}</p>
                    <p>性別: {{$applicant->sex == 0 ? "男" : "女"}}</p>
                    <p>學生證號碼: {{$applicant->student_id or ""}}</p>
                    <p>護照號碼: {{$applicant->passport_number or ""}}</p>
                    <p>Arc號碼: {{$applicant->arc_number or ""}}</p>
                    <p>電話號碼: {{$applicant->phone_number or ""}}</p>
                    <p>生日: {{$applicant->birthday or ""}}</p>
                    <p>地址: {{$applicant->address or ""}}</p>
                    <p>Email: {{$applicant->email or ""}}</p>
                    <p>領過獎學金: {{$applicant->pastScholarship == 0 ? "否" : "是"}}</p>
                    <p>領了多久: {{$applicant->how_long or ""}}</p>

                    <hr>

                    @if(isset($fileURL[$applicant->applicant_id]['transcript_url']) == true)
                        <div class="alert alert-success" role="alert"><a href="{{$fileURL[$applicant->applicant_id]['transcript_url']}}" target="_blank">成績單</a></div>
                    @else
                        <div class="alert alert-warning" role="alert">沒有成績單</div>
                    @endif

                    @if(isset($fileURL[$applicant->applicant_id]['supportDocument_url']) == true)
                        <div class="alert alert-success" role="alert"><a href="{{$fileURL[$applicant->applicant_id]['supportDocument_url']}}" target="_blank">其他輔助文件</a></div>
                    @else
                        <div class="alert alert-warning" role="alert">沒有其他輔助文件</div>
                    @endif

                    @if(isset($fileURL[$applicant->applicant_id]['attachment1_url']) == true)
                        <div class="alert alert-success" role="alert"><a href="{{$fileURL[$applicant->applicant_id]['attachment1_url']}}" target="_blank">附件一</a></div>
                    @else
                        <div class="alert alert-warning" role="alert">沒有附件一</div>
                    @endif

                    <p>須送語文中心審查：{{$applicant->need_attachment2 == 0 ? "否" : "是"}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                </div>
            </div>

        </div>
    </div>
    @endforeach


    <script>

        $(function () {
            $('.optional_input').hide();
        });

        function selectOnChange(sel) {
            if (sel.selectedIndex == 101) {
                $('#' + sel.id).siblings('.optional_input').show();
            } else {
                $('#' + sel.id).siblings('.optional_input').hide();
            }
        }

    </script>

@endsection
