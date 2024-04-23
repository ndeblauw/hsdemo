<x-site-layout title="{{$article->title}}">

    <div class="flex justify-center w-full mb-4 gap-4">
        <a href="{{route('articles.index')}}" class="p-1 bg-teal-500 text-white rounded">Back to index</a>
    </div>

    <div>
        Categories:

        <div class="flex flex-row gap-2">
            @foreach($article->categories as $category)
                <span class="bg-purple-100 text-purple-500 p-1 rounded">
                {{ $category->name }}
            </span>
            @endforeach

        </div>

    </div>

    <div>
        Written by: {{$article->author->name}}
    </div>

    <div class="bg-white">
        {{$article->content}}
    </div>

</x-site-layout>


