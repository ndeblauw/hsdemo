<x-site-layout title="{{$article->title}}">

    <div class="flex justify-center w-full mb-4 gap-4">
        <a href="{{route('articles.index')}}" class="p-1 bg-teal-500 text-white rounded">Back to index</a>
    </div>

    <div>
        Written by: {{$article->author->name}}
    </div>

    <div class="bg-white">
        {{$article->content}}
    </div>

</x-site-layout>


