<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head',['title'=>'グループ編集'])

<body>
    @include('layouts.header')
    <div class="flex flex-col items-center">
        @if ($errors->any())
        <div class="text-red-500">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="flex w-fit justify-start">
            <p class="pt-2">現在のグループ名 : {{$group->name}}</p>
            <!--削除できるようにしたいけどリレーションした投稿をどうしたいか決まらない。保留。-->
            <!--<form action="{{route('group.destroy')}}" method='POST'>-->
            <!--    @csrf-->
            <!--    <input type='hidden' name='group_id' value={{$group->id}}>-->
            <!--    <input type='submit' value='グループを削除' class="p-2 w-32 rounded bg-red-500 hover:bg-red-600 text-white">-->
            <!--</form>-->
        </div>
        <form action="{{route('group.edit')}} " method='POST'>
            @csrf
            <div class="flex justify-between items-center">
                <p>新しいグループ名</p>
                <input type='hidden' name='group_id' value={{$group->id}}>
                <input type='text' name='groupname' value={{$group->name}}>
            </div>
            <div class="flex divide-x mx-auto">
                <div class="px-4">
                    <p>現在のメンバー</p>
                    @foreach($group->users as $user)
                        <ul>{{$user->name}}</ul>
                    @endforeach
                </div>
                <div class="px-4">
                    <p>新しいメンバー</p>
                    <select name='members[]' size=10 multiple>
                        @foreach ($users as $user)
                            @if(in_array($user,$group->users->toArray()))
                                <option value="{{$user->id}}" selected>{{$user->name}}</option>
                            @else
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex justify-between py-1">
                <a href="{{route('index')}}"><button type="button" class="p-2 w-32 rounded bg-gray-500 hover:bg-gray-700 text-white">キャンセル</button></a>
                <input type='submit' value='完了' class="p-2 w-32 rounded bg-blue-500 hover:bg-blue-600 text-white">
            </div>
        </form>
    </div>
</body>
</html>