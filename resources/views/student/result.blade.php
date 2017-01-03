@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                @if(isset($errorMsg))
                <div class="alert alert-danger" role="alert">{{ $errorMsg or "" }}</div>
                @else
                <h1 class="text-center">審查結果</h1>

                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th class="col-md-2">學費減免金額</th>
                        <th class="col-md-2">雜費減免金額</th>
                        <th class="col-md-2">住宿減免金額</th>
                        <th class="col-md-2">生活費補助金額</th>
                        <th class="col-md-4">應繳金額</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$result['tuition_reduce']}}</td>
                        <td>{{$result['miscellaneousFees_reduce']}}</td>
                        <td>{{$result['accommodation_reduce']}}</td>
                        <td>{{$result['living_reduce']}}</td>
                        <td>{{$result['total']}}</td>
                    </tr>
                    </tbody>
                </table>
                @endif
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection
