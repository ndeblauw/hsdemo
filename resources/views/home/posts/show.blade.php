<x-site-layout title="USER ZONE - POSTS">
    <a class="underline" href="{{route('home.posts.index')}}">Back to the index</a>


    <x-crud-success-message/>


    <p class="font-bold">
        {{$post->title}}
    </p>

    <a class="underline" href="{{route('home.posts.edit', $post)}}">Edit</a>

    <form action="{{route('home.posts.destroy', $post)}}" method="post">
        @csrf
        @method('DELETE')
        <button class="underline">Delete</button>
    </form>


</x-site-layout>
