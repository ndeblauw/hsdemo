<x-site-layout title="List of authors">

    <ul class="list-disc ml-5">
        @foreach($authors as $author)
            <li>
                <a class="underline hover:bg-purple-200" href="/authors/{{$author->id}}">
                    {{ $author->name }}
                </a>
            </li>
        @endforeach
    </ul>

</x-site-layout>

