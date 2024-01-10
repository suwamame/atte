@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection
<title>Login</title>

@section('content')
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <a class="header__logo" href="/login">Atte</a>
            </div>
        </div>
    </header>
    
    <main>
        <div class="login-form__content">
            <div class="login-form__heading">
                <h2>ログイン</h2>
            </div>
            <form class="form"  action="{{ route('login.post') }}" method="post">
                @csrf
                <div class="form__group">
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" />
                        </div>
                        <div class="form__error">
                            @error('email')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="password" name="password" placeholder="パスワード" value="{{ old('password') }}" />
                        </div>
                        <div class="form__error">
                            @error('password')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="login__button">
                    <button class="login__button-submit" type="submit">ログイン</button>
                </div>
            </form>
            <div class="login__caption">
                <p>アカウントをお持ちではない方はこちらから</p>
                <nav>
                    <ul class="caption-nav">
                        <li clss="caption-nav__item">
                            <a class="caption-nav__link" href="/register">会員登録</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </main>
    @endsection
    @extends('layouts.app')
</body>

</html>