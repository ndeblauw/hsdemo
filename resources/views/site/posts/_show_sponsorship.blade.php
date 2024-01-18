@if($post->isSponsored() )
    <div class="w-full bg-teal-50 text-teal-500 p-4 rounded my-4">
        This post has been sponsored by {{$post->sponsor->name}}
    </div>
@else
    <div class="w-full bg-pink-600 text-pink-50 p-4 rounded my-4">
        @guest
            You need to log in before you can sponsor the author of this post
        @endguest

        @auth
            <p>Sponsor the author
                <a href="{{route('posts.purchase', ['post' => $post, 'amount' => '5.00'])}}"
                   class="p-2 uppercase font-bold bg-pink-200 text-pink-600 ml-4">Small (€ 5)</a>
                <a href="{{route('posts.purchase', ['post' => $post, 'amount' => '15.00'])}}"
                   class="p-2 uppercase font-bold bg-pink-200 text-pink-600 ml-4">Hero (€ 15)</a>

            </p>
        @endauth
    </div>
@endif
