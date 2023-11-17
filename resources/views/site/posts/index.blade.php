<x-site-layout>

    <div class="mb-4">
        {{$posts->links()}}
    </div>

    <ul class="grid grid-cols-2 gap-4">
    @foreach($posts as $post)

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
                        {{ Str::limit($post->body, 200) }}
                    </div>
                </a>


            </div>

        </li>
    @endforeach
    </ul>

</x-site-layout>
