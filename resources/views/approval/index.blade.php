<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head',['title'=>'ホーム'])
    
<body>
    @include('layouts.header')
    <div class="flex px-1 divide-x">
        <div class="px-2 max-w-1/2">
            <!--検索機能-->
            <div class="flex h-16 items-center">
                <form action="{{route('index')}}" method='get'>
                    @csrf
                    <input type='search' name='search_title' placeholder='タイトルを入力' class="h-8">
                    <input type='search' name='search_user' placeholder='ユーザー名を入力' class="h-8">
                    <select name="accept_yn">
                        <option value=0>未承認</option>
                        <option value=1>承認</option>
                    </select>
                    <input type='submit' value='検索' class="h-8 p-1 rounded-none bg-slate-100 hover:bg-slate-300 text-black border border-gray-700">
                </form>
            </div>
            <!--グループ追加（暫定）-->
            <div class="flex items-center py-1 gap-2">
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
                        <input type='submit' value='グループを編集'>
                    </form>
                </div>
            </div>
            <!--決裁一覧・新規作成-->
            <div class='divide-y'>
                @foreach ($posts as $post)
                    <div>
                        <div class="flex">
                            <div class='mr-3 flex space-x-2 items-center'>
                                <h2 class='title'>
                                    <a href="{{route('show',['id'=>$post->id])}}">{{$post->title}}</a>
                                </h2>
                                <h3 class='post_user'>{{$post->user->name}}({{$post->group->name}})</h3>
                            </div>
                            @if($post->accepts()->where('user_id',$user->id)->first()->pivot->accept==false)
                                <div class='accept_button'>
                                    <form action="{{route('accept',['id'=>$post->id])}}" method='post'>
                                        @csrf
                                        <button class="p-1 rounded bg-green-500 hover:bg-green-700 text-white border-gray-500">承認</button>
                                    </form>
                                </div>
                            @else
                                <div class='disaccept_button'>
                                    <form action="{{route('disaccept',['id'=>$post->id])}}" method='post'>
                                        @csrf
                                        <button class="p-1 rounded bg-red-500 hover:bg-red-700 text-white border-gray-500">承認取消</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                        <p class="line-clamp-2">{!! nl2br(htmlspecialchars($post->body)) !!}</p>
                    </div>
                @endforeach
                <div class='pagination'>
                    {{$posts->links()}}
                </div>
                <div class='make_approval'>
                    <a href="{{route('post')}}">新規決裁の作成</a>
                </div>
            </div>
        </div>
        <div class="px-2">
            <!--決裁詳細-->
            @if(isset($postbody))
            <div>
                <div class="flex items-center space-x-3">
                    <h2>{{$postbody->title}}</h2>
                    <h3 class="text-lg">起案者:{{$postbody->user->name}}({{$postbody->group->name}})</h3>
                    <!--承認関係-->
                    <p class="my-1">承認状況:{{$postbody->accepts()->wherePivot('accept',true)->count()}}/{{$postbody->accepts->count()}}</p>
                    @if($postbody->accepts()->where('user_id',$user->id)->first()->pivot->accept==false)
                        <div class='accept_button'>
                            <form action="{{route('accept',['id'=>$postbody->id])}}" method='post'>
                                @csrf
                                <button class="p-1 rounded bg-green-500 hover:bg-green-700 text-white border-gray-500">承認</button>
                            </form>
                        </div>
                    @else
                        <div class='disaccept_button'>
                            <form action="{{route('disaccept',['id'=>$postbody->id])}}" method='post'>
                                @csrf
                                <button class="p-1 rounded bg-red-500 hover:bg-red-700 text-white border-gray-500">承認取消</button>
                            </form>
                        </div>
                    @endif
                </div>
                <!--本文-->
                <p>本文</p>
                <p class="body w-full min-h-32 border rounded p-1">{!! nl2br(htmlspecialchars($postbody->body)) !!}</p>
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
            <div class="flex">
                <h2 class="text-lg mt-2">コメント</h2>
                @if ($errors->any())
                <div class="text-red-500 mt-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <form action="{{route('comment',['id'=>$postbody->id])}}" method='post'>
                @csrf
                <div class="flex space-x-1">
                    <input type='textarea' name='body' class="grow border border-gray-400 focus:outline-0 focus:ring-1 focus:ring-offset-1 focus:ring-offset-sky-200">
                    <input type='submit' value='送信' class="h-8 p-1 rounded-none bg-slate-100 hover:bg-slate-300 text-black border border-gray-700">
                </div>
            </form>
            <div class="divide-y">
                @foreach($postbody->comments as $comment)
                    <div class="flex justify-between">
                        <p>{{$comment->body}}</p>
                        <p><br>-{{$comment->user->name}}({{$comment->created_at}})</p>
                    </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</body>
</html>