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
                <h2 class='title'>
                    <a href="{{route('show',['id'=>$post->id])}}">{{$post->title}}</a>
                </h2>
                <h3 class='postuser'>{{$post->user->name}}</h3>
            </div>
        @endforeach
        <div class="pagination">
            {{$posts->links()}}
        </div>
        <div class="make_approval">
            <a href="{{route('post')}}">新規決裁の作成</a>
        </div>
    </div>
    <!--決裁詳細-->
    @if(isset($postbody))
    <div class="approval_body">
        <h2 class="title">{{$postbody->title}}</h2>
        <h3 class="postuser">{{$postbody->user->name}}</h3>
        <p class="body">{{$postbody->body}}</p>
    </div>
    @endif
</body>


</html>