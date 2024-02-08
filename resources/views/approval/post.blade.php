<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
<body>
    <h1>post page</h1>
    <div class='form'>
        <form action="{{route('post')}}" method="POST">
            @csrf
            <div class='title'>
                <h2>タイトル</h2>
                <input type="text" name="post[title]">
            </div>
            <div class='body'>
                <h2>内容</h2>
                <input type="textarea" name="post[body]">
            </div>
            <div class='file'>
                <!--あとで考える。-->
            </div>
            <div class='group'>
                <select name="post[group_id]">
                    @foreach ($groups as $group)
                    <option value="{{$group->id}}">{{$group->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class='cancel'>
                <a href="{{route('index')}}">キャンセル</a>
            </div>
            <div class='submit'>
                <input type="submit" value="作成">
            </div>
        </form>
    </div>
</body>


</html>