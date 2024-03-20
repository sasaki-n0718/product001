<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<body>
    <div class='edit'>
        <form action="{{route('group.edit')}} " method='POST'>
            @csrf
            <div class='group_name'>
                <h2>グループ名</h2>
                <p>現在のグループ名{{$group->name}}</p>
                <p>新しいグループ名</p>
                <input type='hidden' name='group_id' value={{$group->id}}>
                <input type='text' name='groupname' value={{$group->name}}>
            </div>
            <div class='member'>
                <h2>メンバー</h2>
                <p>現在のメンバー</p>
                @foreach($group->users as $user)
                    <ul>{{$user->name}}</ul>
                @endforeach
                <p>新しいメンバー</p>
                <!--上手くいかない、保留。-->
                <select name='members[]' size=10 multiple>
                    @foreach ($users as $user)
                        @if(in_array($user,$group->users->toArray()))
                            <option value="{{$user->id}}" selected>{{$user->name}}</option>
                        @else
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class='submit'>
                <input type='submit' value='完了'>
            </div>
        </form>
    </div>
    <div class='delete'>
        <form action="{{route('group.destroy')}}" method='POST'>
            @csrf
            <input type='hidden' name='group_id' value={{$group->id}}>
            <input type='submit' value='削除'>
        </form>
    </div>
    <div class='cancel'>
        <a href="{{route('index')}}">キャンセル</a>
    </div>
</body>
</html>