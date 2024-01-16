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
                        <li class="header-nav-list">
                            <a class="header-nav__link" href="/login">ホーム</a>
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
            <div class="stamp-form__inner">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <div class="stamp-form__heading">
                    <h2>{{ Auth::user()->name }}さんお疲れ様です！</h2>
                </div>
                <table>
                    <tr>
                        <form class="stamp-form" action="{{ route('start.working') }}" method="post">
                            @csrf
                            <td class="stamp__button"><button class="start-form__button-submit" type="submit">勤務開始</button></td>
                        </form>
                        <form class="stamp-form" action="{{ route('end.working') }}" method="post">
                            @csrf
                            <td class="stamp__button"><button class="end-form__button-submit" type="submit">勤務終了</button></td>
                        </form>
                    </tr>
                    <tr class="stamp__bottom">
                        <form class="stamp-form" action="{{ route('start.break') }}" method="post">
                            @csrf
                            <td class="stamp__button"><button class="breakstart-form__button-submit" type="submit">休憩開始</button></td>
                        </form>
                        <form class="stamp-form" action="{{ route('end.break') }}" method="post">
                            @csrf
                            <td class="stamp__button"><button class="breakend-form__button-submit" type="submit">休憩終了</button></td>
                        </form>
                    </tr>
                </table>
            </div>
        </div>
    </main>
    @endsection
    @extends('layouts.app')
</body>
