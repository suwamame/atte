@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection
<title>attendance</title>

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
        <div class="attendance-form__content">
            //日付ごとのページネーションを設定予定
            <div class="attendance-table">
                <table class="attendance-table__inner">
                    <tr class="attendance-table__row">
                        <th class="attendance-table__header">
                            <span class="attendance-table__header-span">名前</span>
                            <span class="attendance-table__header-span">勤務開始</span>
                            <span class="attendance-table__header-span">勤務終了</span>
                            <span class="attendance-table__header-span">休憩時間</span>
                            <span class="attendance-table__header-span">勤務時間</span>
                        </th>
                    </tr>
                    <tr class="attendance-table__row">
                        <td class="attendance-table__item">
                            <form class="update-form" action="" method="post">
                                <div class="update-form__item">
                                    <input class="update-form__item-input" type="text" name="content" value="" />
                                    <input type="hidden" name="id" value="" />
                                </div>
                                <div class="update-form__item">
                                    <p class="update-form__item-p">Category 1</p>
                                </div>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
            //ページネーションを作成予定
        </div>
    </main>
    @endsection
    @extends('layouts.app')
</body>

</html>