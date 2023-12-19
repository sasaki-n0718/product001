<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
<body>
    <h1><a href=/>home page</a></h1>
    <!--検索機能-->
    <div class='search'>
        <form action="{{route('index')}}" method="get">
            @csrf
            <input type="text" name="keyword" placeholder="検索キーワードを入力してください">
            <input type="submit" value="検索">
        </form>
    </div>
    <!--ログインユーザ表示-->
    <div class='username'>
        <p>ログイン中：{{$user->name}}</p>
        <form action="{{route('logout')}}" method="post">
            @csrf
            <button>ログアウト</button>
        </form>
    </div>
    <!--決裁一覧・新規作成-->
    <div class='list'>
        @foreach ($posts as $post)
            <div class='post'>
                <h2 class='title'>{{ $post->title }}</h2>
                <p class='postuser'>{{ $post->user->name }}</p>
            </div>
        @endforeach
        <div class="pagination">
            {{$posts->links()}}
        </div>
        <div class="make_approval">
            <a href="{{route('post')}}">新規決裁の作成</a>
        </div>
    </div>
</body>


</html>