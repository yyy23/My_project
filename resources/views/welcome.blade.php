<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link href="{{ asset('css/forum.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="login_register">
            @if (Route::has('login'))
                <div class="links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title">
                    <h1>子育てお悩み・雑談へようこそ</h1>
                    <p><h2>ママ・パパのお悩みや息抜きに気軽にお話しましょう</h2></p>
                </div>

        
            </div>
        </div>
    </body>
</html>
