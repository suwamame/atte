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
                    @foreach($attendances as $attendance)
                    <tr class="attendance-table__row">
                        <td class="attendance-table__item">
                            <!-- 勤怠データの表示を行う部分 -->
                            <p>{{ $attendance->user->name }}</p>
                            <p>{{ $attendance->start_time }}</p>
                            <p>{{ $attendance->end_time }}</p>
                            <p>{{ $attendance->break_time }}</p>
                            <p>{{ $attendance->work_time }}</p>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            //ページネーションを作成予定
        </div>
    </main>
    @endsection
    @extends('layouts.app')
</body>

</html>