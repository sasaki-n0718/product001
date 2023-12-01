<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
<body>
    <h1><a href=/>home page</a></h1>
    <!--検索機能-->
    <div class='search'>
        <form action="/" method="get">
            <input type="text" name="keyword" placeholder="検索キーワードを入力してください">
            <input type="submit" value="検索">
        </form>
    </div>
    <!--決裁一覧・新規作成-->
    <div class='list'>
        @foreach ($posts as $post)
            <div class='post'>
                <h2 class='title'>{{ $post->title }}</h2>
                {{--<p class='user'>{{ $post->user->name }}</p>--}}
                <!--ユーザー名を表示させたい。-->
            </div>
        @endforeach
        <div class="pagination">
            {{$posts->links()}}
        </div>
        <div class="make_approval">
            <a href="/post">新規決裁の作成</a>
        </div>
    </div>
</body>


</html>