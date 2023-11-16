<div class="bg-gray-300 pt-12">
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <h2 class="font-bold">Featured for you today</h2>
        <div class="grid grid-cols-4 gap-4">
            @foreach($featured_news as $post)
                <div class="bg-white p-2">
                    {{$post->title }}
                </div>
            @endforeach
        </div>
    </div>
</div>
