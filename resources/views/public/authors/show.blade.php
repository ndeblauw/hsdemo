<x-site-layout title="Details of {{$author->name}}">

    <p>
        Our guest author <strong>{{$author->name}}</strong> has written the following articles:
    </p>

    <div class="grid grid-cols-2 gap-8">
        @foreach($author->articles as $article)

            <x-article-display-card :article="$article"/>

        @endforeach
    </div>


    <div class="w-full text-center mt-6">
        <a class="p-2 bg-teal-500 text-white hover:bg-teal-700 rounded text-sm uppercase" href="/authors">Check out the other authors</a>
    </div>


</x-site-layout>
