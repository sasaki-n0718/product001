<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
<body>
    <h1>post page</h1>
    <div class='form'>
        <form action="/post" method="POST">
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
                <!--あとで考える。
                <select name="group">
                    {{--@foreach ()
                    <option>{{group}}</option>
                    @endforeach
                    <option selected="selected">{{group}}</option>
                    ログインしてる人のグループ属性を参照したい。
                </select>--}}
                -->
            </div>
            <div class='cancel'>
                <a href="/">キャンセル</a>
            </div>
            <div class='submit'>
                <input type="submit" value="作成">
            </div>
        </form>
    </div>
</body>


</html>