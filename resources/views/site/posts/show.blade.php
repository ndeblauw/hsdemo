


<x-site-layout title="{{$post->title}}">

    @if(session()->has('referrer'))
    <div class="bg-pink-500 text-pink-50 p-4 rounded my-4">
        This article is recommended to you by {{session()->get('referrer')}}
    </div>
    @endif


    <div class="flex justify-between gap-x-8">
        <div>
            @if( session()->has('purchase_success'))
                <div class="w-full bg-green-600 text-green-50 p-4 rounded my-4">
                    {{ session()->get('purchase_success') }}
                </div>
            @endif

                @if( session()->has('purchase_pending'))
                    <div class="w-full bg-yellow-600 text-yellow-50 p-4 rounded my-4">
                        {{ session()->get('purchase_pending') }}
                    </div>
                @endif


            @if($post->isSponsored() )
                <div class="w-full bg-pink-600 text-pink-50 p-4 rounded my-4">
                    This post has been sponsored by {{$post->sponsor->name}}
                </div>
            @else
                <div class="w-full bg-pink-600 text-pink-50 p-4 rounded my-4">
                    @guest
                        You need to log in before you can sponsor the author of this post
                    @endguest

                    @auth
                        <p>Sponsor the author
                            <a href="{{route('posts.purchase', ['post' => $post, 'amount' => '5.00'])}}" class="p-2 uppercase font-bold bg-pink-200 text-pink-600 ml-4">Small (€ 5)</a>
                            <a href="{{route('posts.purchase', ['post' => $post, 'amount' => '15.00'])}}" class="p-2 uppercase font-bold bg-pink-200 text-pink-600 ml-4">Hero (€ 15)</a>

                        </p>
                    @endauth
                </div>
            @endif

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

        <div class="w-1/4">
            <livewire:weather-show-plugin />
        </div>
    </div>

</x-site-layout>
