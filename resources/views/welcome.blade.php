<x-site-layout title="Welcome" >

    {{__('Hello, how are you doing') }}

    <div class="flex gap-6">
        <div class="w-2/3">
            <h2 class="font-bold">Latest News</h2>
            <ul class="grid grid-cols-1 gap-8">
                @foreach($recent_news as $post)

                    <li class="block shadow-sm bg-white hover:shadow-lg rounded-lg grid grid-cols-3 group overflow-hidden">

                        <a href="{{route('posts.show', ['post' => $post])}}" class="block h-full bg-red-50 rounded-l overflow-hidden">
                            <img src="{{$post->getImageUrl('preview')}}" class="rounded-l h-full group-hover:scale-110 transition duration-500 cursor-pointer object-cover">
                        </a>

                        <div class="col-span-2 p-2">
                            <div class="flex gap-x-2 mb-2">
                                @foreach($post->categories as $category)
                                    <a href="{{route('categories.show', ['id' => $category->id])}}" class="uppercase bg-teal-500 hover:bg-teal-600 text-white rounded-full py-1 px-4 text-xs">
                                        {{$category->name}}
                                    </a>
                                @endforeach
                            </div>

                            <a href="{{route('posts.show', ['post' => $post])}}" class="">
                                <h2 class="font-bold text-lg line-clamp-1" >{{$post->title}}</h2>
                                <span class="">{{$post->author?->name ?? 'UNKNOWN AUTHOR' }}</span>
                                <span class="text-teal-500 mx-1">|</span>
                                <span>{{$post->published_at->format('Y-m-d H:i')}}</span>

                                <div class="px-1 pt-2 line-clamp-3">
                                    {{ Str::limit( strip_tags($post->body), 200) }}
                                </div>
                            </a>


                        </div>

                    </li>
                @endforeach
            </ul>
        </div>

        <div class="w-1/3 border border-teal-500 rounded-sm p-4">
            <h2 class="font-bold">Our top authors</h2>
            <div class="grid gap-4">
                @foreach($authors as $author)
                    <div>
                        {{$author->name }}
                    </div>
                @endforeach

            </div>

        </div>
    </div>




</x-site-layout>
