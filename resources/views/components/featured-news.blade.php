<div class="bg-gray-300">

    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="flex justify-center mx-4 py-6">
            <h2 class="text-lg border-t border-b mb-4 border-gray-500 ">Featured for you today</h2>
        </div>
        <div class="grid grid-cols-4 gap-4">
            @foreach($featured_news as $post)
                <div class="relative bg-white p-2 group">
                    <a href="{{route('posts.show', ['post' => $post])}}" class="relative block h-full rounded-l overflow-hidden">
                        <img src="{{$post->getImageUrl('preview')}}" class="rounded-l h-full group-hover:scale-110 transition duration-500 cursor-pointer object-cover">
                    </a>
                    <a href="{{route('posts.show', ['post' => $post])}}" class="">
                        <h2 class="absolute p-2 bottom-2 mr-2 text-white font-bold bg-black bg-opacity-50 group-hover:font-extrabold">
                            {{$post->title }}
                        </h2>

                    </a>

                </div>
            @endforeach
        </div>
    </div>
</div>
