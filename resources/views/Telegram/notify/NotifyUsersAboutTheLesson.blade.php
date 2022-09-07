Оповещение системы
Занятие начнётся через 15 минут
Группа: {{$group->name}}
Преподаватель:@if(count($teachers)==0) <i>Не назначен</i>@else @foreach($teachers as $teacher){{'@' . $teacher->tg_username}}@endforeach @endif

