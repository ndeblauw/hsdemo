<div class="bg-gray-300 pt-12">

    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="flex justify-center mx-4">
            <h2 class="text-lg border-t border-b mb-4 border-gray-500 ">Featured for you today</h2>
        </div>
        <div class="grid grid-cols-4 gap-4">
            @foreach($featured_news as $post)
                <div class="bg-white p-2">
                    {{$post->title }}
                </div>
            @endforeach
        </div>
    </div>
</div>
