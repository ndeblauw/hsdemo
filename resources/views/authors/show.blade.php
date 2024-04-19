<x-site-layout title="Details of {{$author->name}}">

    <p>
        Our guest author <strong>{{$author->name}}</strong> has written the following articles:
    </p>

    <ul class="list-disc ml-5">
        @foreach($author->articles as $article)
            <li>
                {{$article->title}}
            </li>
        @endforeach
    </ul>


    <div class="w-full text-center mt-6">
        <a class="p-2 bg-teal-500 text-white hover:bg-teal-700 rounded text-sm uppercase" href="/authors">Check out the other authors</a>
    </div>


</x-site-layout>
