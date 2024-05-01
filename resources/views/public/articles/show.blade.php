<x-site-layout title="{{$article->title}}" hideTitle>

    <div class="flex flex-col md:flex-row gap-x-12">
        <div class="bg-white p-2 w-2/3">

            <div class="flex flex-row gap-2 mb-2">
                @foreach($article->categories as $category)
                    <span class="bg-purple-100 text-purple-500 px-2 rounded-full">
                        {{ $category->name }}
                    </span>
                @endforeach
            </div>
            <h1 class="font-bold text-4xl">{{$article->title}}</h1>


            <div class="my-2">
                <span class="text-teal-400 font-bold">&gt</span>
                Written by: <span class="font-semibold">{{$article->author->name}}</span>
            </div>

            <div>
                <img src="{{$article->getFeaturedImageUrl()}}" class="float-right w-3/5 ml-4 mb-4">
                {!! nl2br($article->content) !!}
            </div>
        </div>


        <div class="w-1/3">
            <h2 class="text-xl font-bold">Related articles</h2>

            <ul class="">
                @foreach($related as $r)
                    <li class="block relative mb-4">
                        <a href="{{route('articles.show', ['id' => $r->id])}}">
                            <img src="{{$r->getCardImageUrl()}}" class="filter grayscale hover:scale-105 w-full rounded-lg hover:shadow">
                            <h3 class="absolute bottom-0 left-2 font-extrabold text-teal-100 line-clamp-1">{{$r->title}}</h3>

                            <div class="flex flex-row gap-2 absolute top-2 right-2 text-xs">
                                @foreach($r->categories as $category)
                                    <span class="bg-purple-100 bg-opacity-75 text-purple-500 px-2 rounded-full">{{ $category->name }}</span>
                                @endforeach
                            </div>
                        </a>
                    </li>

                @endforeach

            </ul>

        </div>

    </div>


    <div class="flex justify-center w-full mt-4 gap-4">
        <a href="{{route('articles.index')}}" class="p-1 bg-teal-500 text-white rounded">Back to index</a>
    </div>


</x-site-layout>


