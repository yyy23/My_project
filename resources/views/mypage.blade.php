@extends('layouts.app')  <!-- layouts:app.blade継承 -->

@section('content')  
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mypage">

                <div class="mypage-header"><h1>{{ auth()->user()->name }}さんのページ</h1></div>

                <div class="guide-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <hr>

                <div class="mypage-body">
                    <p>性別</p>   
                    <p>自己紹介</p>
                    <p>つぶやき</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
