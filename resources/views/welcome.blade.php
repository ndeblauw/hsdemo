<x-site-layout title="The Harbour Space Bangkok Meow">

    <div class="grid grid-cols-2 gap-8">
        @foreach($articles as $article)
            <a href="{{route('articles.show', ['id' => $article->id])}}" class="p-2 bg-white rounded hover:shadow-xl relative">
                <img src="{{$article->getCardImageUrl()}}" class=" w-full">

                <div class="absolute flex flex-row gap-2 absolute top-4 right-4 text-xs">
                    @foreach($article->categories as $category)
                        <span class="bg-purple-100 text-purple-500 px-2 rounded-full">{{ $category->name }}</span>
                    @endforeach
                </div>

                <h3 class="font-bold text-xl">{{$article->title}}</h3>
                <div> <span class="text-teal-400 font-bold">&gt</span> {{$article->author->name }}</div>
                <p class="line-clamp-3">{{ Str::limit($article->content,300)}}</p>
            </a>
        @endforeach
    </div>

</x-site-layout>
