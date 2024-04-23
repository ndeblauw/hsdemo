<x-site-layout title="List of articles">

    <div class="grid grid-cols-2 gap-8">
        @foreach($articles as $article)
            <a href="{{route('articles.show', ['id' => $article->id])}}" class="p-2 bg-white rounded hover:shadow-xl">
                <h3 class="font-bold text-xl">{{$article->title}}</h3>
                <div class="text-purple-500">Author: {{$article->author->name }}</div>
                <p>{{$article->content}}</p>
            </a>
        @endforeach
    </div>

</x-site-layout>
