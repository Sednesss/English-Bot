Ваше имя: <b>{{$user->name}}</b>
Должность: @foreach($user->roles->pluck('name') as $qwe) <i>{{$qwe}}</i>@endforeach

