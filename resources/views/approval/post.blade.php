<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
<body>
    <h1>post page</h1>
    <div class='form'>
        <form action="{{route('post')}}" method="POST" enctype='multipart/form-data'>
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
                <h2>ファイルを添付（Ctrlで複数選択可）</h2>
                <input type='file' id='file' name='file[]' class='form_controll' multiple>
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