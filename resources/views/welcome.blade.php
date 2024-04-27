<x-site-layout title="The Harbour Space Bangkok Meow">

    <div class="grid grid-cols-2 gap-8">
        @foreach($articles as $article)

            <x-article-display-card :article="$article"/>
        @endforeach
    </div>

</x-site-layout>
