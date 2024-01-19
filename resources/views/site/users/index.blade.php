



<x-site-layout title="Authors overview">
    <p class="mb-6">We currently have {{$users->count()}} active authors</p>
    <ul class="grid grid-cols-2 gap-4">
        @foreach($users as $user)
            <li class="block p-2 shadow-sm bg-white rounded-lg">
                <a class="flex justify-between" href="{{route('users.show', ['user' => $user])}}">
                    <h2 class="font-bold text-lg" >{{$user->name}}</h2>
                    <span>{{$user->posts_count}}</span>
                </a>
            </li>
        @endforeach
    </ul>
</x-site-layout>
