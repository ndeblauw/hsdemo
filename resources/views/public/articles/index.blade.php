<x-site-layout title="List of articles">

    <div class="mb-2">
        {{$articles->links()}}
    </div>

    <div class="grid grid-cols-2 gap-8">
        @foreach($articles as $article)

            <x-article-display-card :article="$article" />
        @endforeach
    </div>

</x-site-layout>
