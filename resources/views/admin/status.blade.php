@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center">
            <h1>申請開關</h1>
            <button type="button" class="btn btn-lg btn-default">開放申請</button>
            <button type="button" class="btn btn-lg btn-default">關閉申請</button>
        </div>
        <div class="text-center">
            <h1>審查開關</h1>
            <button type="button" class="btn btn-lg btn-default">開放審查</button>
            <button type="button" class="btn btn-lg btn-default">關閉審查</button>
        </div>
        <div class="text-center">
            <h1>公告結果</h1>
            <button type="button" class="btn btn-lg btn-default">公告結果</button>
            <button type="button" class="btn btn-lg btn-default">清除結果</button>
        </div>
        <div class="text-center">
            <h1>審查許可權</h1>
            <div class="btn-group" role="group" aria-label="...">
                <button type="button" class="btn btn-default">院辦</button>
                <button type="button" class="btn btn-default">系辦</button>
            </div>
            <button type="button" class="btn btn-lg btn-default">確認</button>
        </div>

    </div>
@endsection