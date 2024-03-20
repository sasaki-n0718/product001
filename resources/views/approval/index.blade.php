<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
<body>
    <h1><a href=/>home page</a></h1>
    <!--検索機能-->
    <div class='search'>
        <form action="{{route('index')}}" method='get'>
            @csrf
            <input type='search' name='keyword' placeholder='検索キーワードを入力してください'>
            <input type='submit' value='検索'>
        </form>
    </div>
    <!--グループ追加（暫定）-->
    <div class='group_create'>
        <a href="{{route('group.create')}}">グループを追加</a>
    </div>
    <div class='group_edit'>
        <form action="{{route('group.edit'),}}" method='get'>
            @csrf
            <select name='group_id'>
                @foreach($user->groups as $group)
                <option value="{{$group->id}}">{{$group->name}}</option>
                @endforeach
            </select>
            <input type='submit' value='グループを編集・削除'>
        </form>
    </div>
    <!--ログインユーザ表示-->
    <div class='user_name'>
        <p>ログイン中：{{$user->name}}</p>
        <form action="{{route('logout')}}" method='post'>
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
                <h3 class='post_user'>{{$post->user->name}}({{$post->group->name}})</h3>
            </div>
        @endforeach
        <div class='pagination'>
            {{$posts->links()}}
        </div>
        <div class='make_approval'>
            <a href="{{route('post')}}">新規決裁の作成</a>
        </div>
    </div>
    <!--決裁詳細-->
    @if(isset($postbody))
    <!--承認関係-->
    <div class='accept_count'>
        <p>承認状況{{$postbody->accepts()->wherePivot('accept',true)->count()}}/{{$postbody->accepts->count()}}</p>
    </div>
    <div cllass='accept_button'>
        <form action="{{route('accept',['id'=>$postbody->id])}}" method='post'>
            @csrf
            <button>承認</button>
        </form>
    </div>
    <!--本文-->
    <div class='approval_body'>
        <h2 class='title'>{{$postbody->title}}</h2>
        <h3 class='post_user'>{{$postbody->user->name}}({{$postbody->group->name}})</h3>
        <p class='body'>{{$postbody->body}}</p>
        @if(isset($postbody->attachments))
            @foreach($postbody->attachments as $file)
                <a href="{{route('download',['id'=>$file->id])}}">{{$file->name}}</a>
            @endforeach
        @endif
    </div>
    <!--編集-->
    <div class='edit'>
        <a href="{{route('edit',['id'=>$postbody->id])}}">編集</a>
    </div>
    <!--コメント-->
    <div class='comments'>
        <h2 class='comment'>コメント</h2>
        <form action="{{route('comment',['id'=>$postbody->id])}}" method='post'>
            @csrf
            <input type='textarea' name='body'>
            <input type='submit' value='送信'>
        </form>
        @foreach($postbody->comments as $comment)
            <p>{{$comment->body}}</p>
            <p class>{{$comment->user->name}}</p>
        @endforeach
    </div>
    @endif
</body>


</html>