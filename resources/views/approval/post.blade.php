<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head',['title'=>'決裁作成'])
    
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
        <h1 class="text-base">決裁を作成</h1>
        <form action="{{route('post')}}" method="POST" enctype='multipart/form-data' class="justify-center">
            @csrf
            <div class="flex gap-2 m-1">
                <h2 class="text-base items-center">タイトル：</h2>
                <input type="text" name="post[title]" class="grow max-w-full h-8 items-center">
            </div>
            <!---->
            <div class="flex items-center gap-2 m-1">
                <h2 class="text-base items-center">グループ：</h2>
                <select name="post[group_id]" class="grow max-w-full">
                    @foreach ($groups as $group)
                    <option value="{{$group->id}}">{{$group->name}}</option>
                    @endforeach
                </select>
            </div>
            <!---->
            <div class="flex justify-start">
                <label class="text-sm ms-1">本文</label>
            </div>
            <div class="flex m-1">
                <textarea name="post[body]" class="rounded h-24 border border-gray-400 focus:outline-0 focus:ring-1 focus:ring-offset-1 focus:ring-offset-sky-200 w-full resize"></textarea>
            </div>
            <!---->
            <div class="flex items-center w-full">
                <input type='file' id='file' name='file[]' class='form_controll' multiple>
            </div>
            <!---->
            <div class="flex justify-between w-full m-1">
                <a href="{{route('index')}}"><button type="button" class="p-2 w-32 rounded bg-gray-500 hover:bg-gray-700 text-white border-gray-700">キャンセル</button></a>
                <input type="submit" value="作成" class="p-2 w-32 rounded bg-blue-500 hover:bg-blue-600 text-white border-blue-700">
            </div>
        </form>
    </div>
    <script defer>
    document.addEventListener('DOMContentLoaded', function () {
    const textarea = document.getElementById('autoResizeTextarea');
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });
    });
    </script>
</body>
</html>