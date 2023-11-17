

<x-site-layout title="{{$user->name}}">

    {{$user->email}}
    {{$user->created_at}}

    <h2 class="font-bold">Posts by this author</h2>
    <ul class="list-disc ml-5">
        @foreach($user->posts as $post)
            <li>
                <a href="{{route('posts.show', ['id' => $post->id])}}">{{$post->title}}</a>
            </li>
        @endforeach
    </ul>
</x-site-layout>
