<x-site-layout title="List of articles">

    <div class="mb-2">
        {{$articles->links()}}
    </div>

    <div class="grid grid-cols-2 gap-8">
        @foreach($articles as $article)
            <a href="{{route('articles.show', ['id' => $article->id])}}" class="p-2 bg-white rounded hover:shadow-xl">
                <img src="{{$article->getCardImageUrl()}}" class=" w-full">

                <h3 class="font-bold text-xl">{{$article->title}}</h3>
                <div> <span class="text-teal-400 font-bold">&gt</span> {{$article->author->name }}</div>
                <p class="line-clamp-3">{{ Str::limit($article->content,300)}}</p>
            </a>
        @endforeach
    </div>

</x-site-layout>
