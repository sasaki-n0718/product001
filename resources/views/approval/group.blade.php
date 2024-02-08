<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<body>
    <div class='form'>
        <form action="{{route('group')}} " method="POST">
            @csrf
            
            <div class='group.name'>
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
</body>
</html>