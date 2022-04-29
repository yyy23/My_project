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
                    <hr>

                    <!-- チャットルーム画像表示  -->
                    <div>
                        @if ($room ->image_url !=='')
                            <img src="{{ ($room ->image_url) }}" width="30%">
                        @else
                            <img src="{{ ('rooms/no_image.png') }}">
                        @endif
                    </div>    
                    <p>説明：{{ $room ->explanation}}</p>  <!--  チャットルームの説明  -->

                    <form action= "{{ route('chat.store' , \Auth::user()->id) }}" method="POST">
                        {{ csrf_field() }}
                        <label for= 'content'>投稿：</label>
                            <textarea name= 'content'  cols= '30' rows= '2'> </textarea><br>
                            <input type='submit' value='送信'>
                    </form>    
                    <!-- 投稿内容の表示  -->
                    <hr>
                        @if (count($chats) > 0)   <!-- $chatsがある場合、foreachで投稿数分を表示 -->
                            @foreach ($chats as $chat)   
                            <p>{{ $chat ->user_id }}さん</p> <!--  チャットのユーザ名  -->
                            <p><h2>{{ $chat ->content }}</h2></p> <!--  チャットの内容  --> 
                            @endforeach
                        @endif                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
