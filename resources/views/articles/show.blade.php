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



        </div>

    </div>


    <div class="flex justify-center w-full mt-4 gap-4">
        <a href="{{route('articles.index')}}" class="p-1 bg-teal-500 text-white rounded">Back to index</a>
    </div>


</x-site-layout>


