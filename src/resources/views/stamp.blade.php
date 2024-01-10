@section('css')
<link rel="stylesheet" href="{{ asset('css/stamp.css') }}">
@endsection
<title>stamp</title>

@section('content')

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <a class="header__logo" href="/stamp">Atte</a>
                <nav>
                    <ul class="header-nav">
                        <li clss="header-nav-list">
                            <a class="header-nav__link" href="/stamp">ホーム</a>
                            <a class="header-nav__link" href="/attendance">日付一覧</a>
                            <a class="header-nav__link" href="/login">ログアウト</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <div class="stamp-form__content">
            <div class="stamp-form__heading">
                <h2>さんお疲れ様です！</h2>
            </div>
            <form class="stamp-form">
                <div class="form__button">
                    <button class="start-form__button-submit" type="button">勤怠開始</button>
                    <button class="end-form__button-submit" type="button">勤怠終了</button>
                </div>
                <div class="form__button">
                    <button class="breakstart-form__button-submit" type="button">休憩開始</button>
                    <button class="breakend-form__button-submit" type="button">休憩終了</button>
                </div>
            </form>
        </div>
    </main>
    @endsection
    @extends('layouts.app')
</body>

</html>