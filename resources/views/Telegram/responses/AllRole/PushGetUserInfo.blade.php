Ваше имя: <b>{{$user->name}}</b>
Ваш статус: @foreach($user->roles->pluck('name') as $qwe) <i>{{$qwe}}</i>@endforeach

