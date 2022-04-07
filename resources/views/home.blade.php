@extends('layouts.app')  <!-- layouts:app.blade継承 -->

@section('content')  
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="home_guide">
                <div class="guide-header"></div>

                <div class="guide-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <p>おかえりなさい、いつもお疲れ様☆ ちょっと一息しましょうよ</p>
                        <hr>
                        <p>どこのお部屋でお話しする？</p>
  
                        <ul>    
                            <li><a href=" ">０歳児のお部屋</a></li>
                            <li><a href=" ">１歳児のお部屋</a></li>
                            <li><a href=" ">２〜３歳児のお部屋</a></li>
                            <li><a href=" ">４〜６歳児のお部屋</a></li>
                        </ul>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
