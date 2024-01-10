
@section('css')
<link rel="stylesheet" href="css/register.css" />
@endsection
    <title>register</title>

@section('content')
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <a class="header__logo" href="/register">Atte</a>
            </div>
        </div>
    </header>

    <main>
        
        <div class="register-form__content">
            <div class="register-form__heading">
                <h2>会員登録</h2>
            </div>
            <form class="form" action="/register" method="post">
                @csrf
                <div class="form__group">
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="name" placeholder="名前" value="{{ old('name') }}" />
                        </div>
                        <div class="form__error">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}"  />
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
                            <input type="password" name="password" placeholder="パスワード" value="{{ old('password') }}"  />
                        </div>
                        <div class="form__error">
                            @error('password')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="password" name="password_confirmation" placeholder="確認用パスワード" value="{{ old('confirm_password') }}"  />
                        </div>
                        <div class="form__error">
                            @error('confirm_password')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="register__button">
                    <button class="register__button-submit" type="submit">会員登録</button>
                </div>
            </form>
            <div class="register__caption">
                <p>アカウントをお持ちの方はこちらから</p>
                <nav>
                    <ul class="caption-nav">
                        <li clss="caption-nav__item">
                            <a class="caption-nav__link" href="{{ route('login') }}">ログイン</a>
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