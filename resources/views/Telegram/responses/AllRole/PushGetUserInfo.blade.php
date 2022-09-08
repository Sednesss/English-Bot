Ваше имя: <b>{{$user->name}}</b>
Ваш статус: @foreach($user->roles->pluck('name') as $role_name) <i>{{$role_name}}</i>@endforeach
{{"\n"}}Ваши группы:@if(count($user->groups) == 0) <s>Не состоите в группах</s>@else @foreach($user->groups as $group) <i>{{$group->name}}</i>@endforeach @endif
