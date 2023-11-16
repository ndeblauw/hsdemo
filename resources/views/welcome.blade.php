<x-site-layout title="Welcome" >

    <h2 class="font-bold">Latest News</h2>
    <div class="grid grid-cols-3 gap-4">
        @foreach($recent_news as $post)
            <div>
                {{$post->title }}
            </div>
        @endforeach

    </div>




</x-site-layout>
