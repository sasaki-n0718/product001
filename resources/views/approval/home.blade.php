<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
<body>
    <h1>home page</h1>
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