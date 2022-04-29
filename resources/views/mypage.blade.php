@extends('layouts.app')  <!-- layouts:app.blade継承 -->

@section('content')  
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mypage">

                <div class="guide-header">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                </div>

                <div class="mypage-header">
                <!--アバター画像を表示-->        
                
                    <div>
                    @if ($profile ->avater_url == null)  <!--画像が空であればデフォルト画像,空でなければファイル画像表示 -->  <!--画像が空でなければ表示、空であればデフォルト画像を表示 -->
                        <img src="{{ \Storage::url('storage/img/no_image.png') }}">   
                    @else
                        <img src="{{ \Storage::url($profile->avater_url) }}" width="15%" height="15%">  <!--public下のstorage/にある画像ファイルにアクセス-->
                    @endif
                    </div>  

                <!-- 認証ユーザ名を表示  -->
                    <h1>{{ auth()->user()->name }}さん</h1>
                    
                <!--  マイページ編集画面へのリンク  -->
                    <a href= "{{ route('profile.edit' , \Auth::user()->id) }}" >マイページ編集</a>
                </div>
                <hr>

                <!--  マイページ表示内容  -->  
                <div class="mypage-body">    <!--old関数で前回入力値を表示、入力がなけれ’未入力’と表示-->
                    <p>性別：{{ old('gender')  ?? $profile->gender }}</p>  
                    <p>自己紹介：{{ old('introduction') ?? $profile->introduction }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
