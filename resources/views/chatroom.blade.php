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
                        <img src="{{ ($room ->image_url) }}" width="30%">
                        <p>{{ $room ->explanation}}</p>  <!--  チャットルームの説明  -->
                    </div>    
                    <!--投稿フォーム-->
                    <form action= "{{ route('chat.store' , \Auth::user()->id) }}" method="POST">
                        <input type="hidden" name="room_id" value="{{$room ->id}}">
                        {{ csrf_field() }}
                        <label for= 'content'>投稿：</label>
                            <textarea name= 'content'  cols= '30' rows= '2'> </textarea><br>
                            <input type='submit' value='送信'>
                    </form>    
                    <!-- 投稿内容の表示  -->
                    <hr>
                        @if (count($chats) > 0)   <!-- $chatsがある場合、foreachで投稿数分を表示 -->
                            @foreach ($chats as $chat)   
                                <p>{{ $chat ->user->name }}さん</p> <!--  チャットのユーザ名  -->
                                <p><h2>{{ $chat ->content }}</h2></p> <!--  チャットの内容  --> 

                    <!-- チャット削除ボタン  -->
                                @if(Auth::user()->id === $chat->user_id) <!-- 認証ユーザIDとチャット投稿ユーザIDが一致したら削除ボタン表示 -->
                                <form action= "{{ route('chat.destroy' , $chat->id) }}" method="POST">  
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value= "{{$chat ->id}}"> <!-- {chat_id}を隠して詳細画面に渡す -->
                                    <input type= "submit" name= "chat_delete" value= "削除">
                                </form>
                                @endif  
                                <hr>
                            @endforeach
                        @endif                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
