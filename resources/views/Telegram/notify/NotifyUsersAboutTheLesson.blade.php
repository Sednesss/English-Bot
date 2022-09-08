Оповещение системы
Занятие начнётся {{$proposal}} {{$time}}
Группа: {{$group->name}}
Преподаватель:@if(count($teachers)==0) <i>Не назначен</i>@else @foreach($teachers as $teacher){{'@' . $teacher->tg_username}}@endforeach @endif

