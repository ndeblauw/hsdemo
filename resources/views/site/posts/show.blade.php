


<x-site-layout title="{{$post->title}}">

    @if(session()->has('referrer'))
    <div class="bg-pink-500 text-pink-50 p-4 rounded my-4">
        This article is recommended to you by {{session()->get('referrer')}}
    </div>
    @endif

    <div class="flex justify-between gap-x-8">
        <div>
            @include('site.posts._show_purchase_flash_messages')

            @include('site.posts._show_sponsorship')

            <img src="{{$post->getImageUrl('thumbnail')}}" alt="{{$post->title}}" class="mb-4">

            @foreach($post->categories as $category)
                <a href="{{route('categories.show', ['id' => $category->id])}}" class="bg-teal-500 mb-4 text-white rounded-full py-1 px-4 text-sm">
                    {{$category->name}}
                </a>
            @endforeach

            <div class="mb-2 font-semibold">
                written by: <a class="underline" href="{{route('users.show', ['user' => $post->author])}}">{{$post->author->name}}</a>
            </div>
            {{$post->published_at}}
            {!! $post->body !!}

        </div>

        <div class="w-1/4 flex-shrink-0">
{{--
            <livewire:weather-show-plugin />
--}}
        </div>
    </div>

</x-site-layout>
