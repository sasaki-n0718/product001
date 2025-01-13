<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head',['title'=>'決裁編集'])

<body>
    @include('layouts.header')
    <div class="flex flex-col w-96 shrink">
        @if ($errors->any())
        <div class="text-red-500">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{route('edit',['id'=>$postbody->id])}}" method="POST" enctype='multipart/form-data' class="justify-center">
            @csrf
            <div class='flex gap-2 m-1'>
                <h2 class="text-base items-center">タイトル</h2>
                <input type="text" name="post[title]" value="{{$postbody->title}}" class="grow max-w-full h-8 items-center">
            </div>
            <div class='flex justify-start'>
                <h2>本文</h2>
            </div>
            <div class="flex m-1">
                <textarea name="post[body]" value="{{$postbody->body}}" class="rounded h-24 border border-gray-400 focus:outline-0 focus:ring-1 focus:ring-offset-1 focus:ring-offset-sky-200 w-full resize"></textarea>
            </div>
            <!--<div class='file'>
                <h2>ファイルを添付（Ctrlで複数選択可）</h2>
                <input type='file' id='file' name='file[]' class='form_controll' multiple>
            </div>-->
            <div class='flex items-center gap-2 m-1'>
                <h2 class="text-base items-center">グループ：</h2>
                <select name="post[group_id]" class="grow max-w-full">
                    @foreach ($groups as $group)
                        @if($postbody->group_id===$group->id)
                            <option value="{{$group->id}}" selected>{{$group->name}}</option>
                        @else
                            <option value="{{$group->id}}">{{$group->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="flex justify-between w-full m-1">
                <a href="{{route('index')}}"><button type="button" class="p-2 w-32 rounded bg-gray-500 hover:bg-gray-700 text-white border-gray-700">キャンセル</button></a>
                <input type="submit" value="更新" class="p-2 w-32 rounded bg-blue-500 hover:bg-blue-600 text-white border-blue-700">
            </div>
        </form>
    </div>
</body>

</html>