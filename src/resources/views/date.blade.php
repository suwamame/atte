@section('css')
<link rel="stylesheet" href="{{ asset('css/date.css') }}">
<link rel="stylesheet" href="{{ asset('path/to/your/css/file.css') }}">

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
            <!-- 日付ごとのページネーションを設定予定 -->
            <div class="pagination-container">
            
            </div>

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
                    @foreach($attendances ?? '' as $attendance)
                    <tr class="attendance-table__row">
                        <td class="attendance-table__item">
                            <!-- 勤怠データの表示部分 -->
                            <span class="attendance-table-span">{{ $attendance->user->name }}</span>
                            <span class="attendance-table-span">{{ $attendance->start_time ? \Carbon\Carbon::parse($attendance->start_time)->format('H:i:s') : '-' }}</span>
                            <span class="attendance-table-span">{{ $attendance->end_time ? \Carbon\Carbon::parse($attendance->end_time)->format('H:i:s') : '-' }}</span>
                            <span class="attendance-table-span">
                                @if ($attendance->breaklogs->count() > 0)
                                @php
                                $breakTimeInSeconds = $attendance->breaklogs->first()->calculateTotalBreakTime();
                                $hours = floor($breakTimeInSeconds / 3600);
                                $minutes = floor(($breakTimeInSeconds % 3600) / 60);
                                $seconds = $breakTimeInSeconds % 60;

                                @endphp
                                {{ sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds) }}
                                @else
                                '-'
                                @endif
                            </span>
                            <span class="attendance-table-span">
                                @if ($attendance->work_time)
                                @php
                                $time = \Carbon\Carbon::parse($attendance->work_time);
                                $hours = $time->format('H');
                                $minutes = $time->format('i');
                                $seconds = $time->format('s');
                                @endphp
                                {{ sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds) }}
                                @else
                                    '-'
                                @endif
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <!-- ページネーションを作成予定 -->
            <div class="pagination-container">
                @foreach($attendances as $attendance)
                 <p>{{ $attendance->column_name }}</p>
                 @endforeach
                 {{ $attendances->links() }}    
                 <style>
                    svg.w-5.h-5 {
                        width: 30px;
                        height: 30px;
                        
                    }
                </style>
                             
            </div>
        </div>
    </main>
    @endsection
    @extends('layouts.app')
</body>

</html>