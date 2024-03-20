<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<body>
    <div class='create'>
        <form action="{{route('group.create')}} " method="POST">
            @csrf
            <div class='group_name'>
                <h2>グループ名</h2>
                <input type="text" name="groupname">
            </div>
            <div class='member'>
                <h2>メンバーを選んでください</h2>
                <select name="members[]" size=10 multiple>
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class='submit'>
                <input type="submit" value="作成">
            </div>
        </form>
    </div>
    <div class='cancel'>
        <a href="{{route('index')}}">キャンセル</a>
    </div>
</body>
</html>