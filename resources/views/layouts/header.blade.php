<header class="flex justify-between items-center text-gray-600 bg-slate-300">
        <h1 class="mt-1 ml-3 text-lg"><a href=/>home page</a></h1>
        <!--ログインユーザ表示-->
        <div class="mr-3 flex space-x-2 items-center">
            <p class="m-1">ログイン中：{{$user->name}}</p>
            <form action="{{route('logout')}}" method='post'>
                @csrf
                <button class="p-1 rounded bg-gray-500 hover:bg-gray-700 text-white border-gray-700">ログアウト</button>
            </form>
        </div>
</header>