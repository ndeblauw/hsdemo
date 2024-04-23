<x-site-layout title="{{$article->title}}">

    <div class="flex justify-center w-full mb-4 gap-4">
        <a href="{{route('articles.index')}}" class="p-1 bg-teal-500 text-white rounded">Back to index</a>

        <a href="{{route('articles.edit', ['article' => $article->id])}}" class="p-1 bg-teal-500 text-white rounded">edit</a>
    </div>

    @if( session('success_message') !== null)
        <div class="bg-green-50 text-green-500 p-2 rounded">
            {{session('success_message')}}
        </div>
    @endif


    <div>
        Written by: {{$article->author->name}}
    </div>

    <div class="bg-white">
        {{$article->content}}
    </div>

</x-site-layout>


