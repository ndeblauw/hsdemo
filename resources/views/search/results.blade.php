<x-site-layout title="Search results for '{{$search_term}}'">


    <div>Your search for '{{$search_term}}' resulted in {{$articles->count()}} results:</div>

    @foreach($articles as $article)

        <a href="{{route('articles.show', ['id' => $article->id])}}" class="mt-2 hover:bg-green-50">
            <h2 class="font-semibold">{{$article->title}}</h2>
            <p>{{ Str::limit($article->content,100) }}</p>
        </a>

    @endforeach


</x-site-layout>
