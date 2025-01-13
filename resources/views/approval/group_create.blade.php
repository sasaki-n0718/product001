<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head',['title'=>'グループ作成'])

<body>
    @include('layouts.header')
    @if ($errors->any())
    <div class="text-red-500">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{route('group.create')}} " method="POST" class="flex-col justify-center w-80 mt-2">
        @csrf
        <div class="flex space-x-4 items-center">
            <h2 class="text-base">グループ名</h2>
            <input type="text" name="groupname" class="w-fit">
        </div>
        <h2 class="text-base mt-2">メンバーを選んでください</h2>
        <select name="members[]" size=10 multiple class="w-full">
            @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
        <div class="flex justify-between">
            <a href="{{route('index')}}"><button type="button" class="p-2 w-32 rounded bg-gray-500 hover:bg-gray-700 text-white border-gray-700">キャンセル</button></a>
            <input type="submit" value="作成" class="p-2 w-32 rounded bg-blue-500 hover:bg-blue-600 text-white">
        </div>
    </form>
</body>
</html>