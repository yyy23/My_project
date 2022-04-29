@extends('layouts.app')  <!-- layouts:app.blade継承 -->

@section('content')  
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mypage">

                <div class="mypage-header">
                    <h1>{{ auth()->user()->name }}さん マイページ編集</h1>
                </div>

                <div class="guide-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>    
                <hr>

                <form action= "{{ route('profile.update' , \Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('PATCH')

                <!-- エラー文の表示 -->
                    @if(count($errors) > 0)
                        <ul class="bg-danger">
                    @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                    @endforeach
                        </ul>
                    @endif  

                <!-- プロフィール編集内容 -->
                    <div class="form-group"> 
                        
                <!-- プロフィール画像表示 -->    
                <div>
                
                    @if ($profile ->avater_url == null)  <!--画像が空であればデフォルト画像,空でなければファイル画像表示 -->  <!--画像が空でなければ表示、空であればデフォルト画像を表示 -->
                        <img src="{{ \Storage::url('storage/img/no_image.png') }}">   
                    @else
                        <img src="{{ \Storage::url($profile->avater_url) }}" width="15%" height="15%">  <!--public下のstorage/にある画像ファイルにアクセス-->
                    @endif
                    
                    </div>   
                     
                <!-- 画像ファイル入力 -->
                        <label for= 'avater'>プロフィール画像：</label>
                            <input type= "file" name= "avater_url" accept="image/png, image/jpg,image/jpeg"><br>

                <!-- 性別 -->
                        <label for= 'gender'> 性別：</label>
                            <input type= 'radio' name= 'gender' value= '女性' {{ old('gender') == '女性' ? 'checked': ''}}>女性</label>  <!--性別が女性なら１を返す-->
                            <input type= 'radio' name= 'gender' value= '男性' {{ old('gender') == '男性' ? 'checked': ''}}>男性</label><br>  <!--性別が男性なら２を返す-->

                <!-- 自己紹介文 -->
                        <label for= 'introduction'>自己紹介：</label>    
                             <textarea name= 'introduction'  cols= '40' rows= '10' placeholder='自己紹介を入力してください'>{{ old('introduction') ?? $profile ->introduction  }}</textarea><br>
                    
                <!-- 更新ボタン --> 
                        <input type='submit' name= 'update' value='更新する'>        
                    </div>    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
