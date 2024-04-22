<x-site-layout title="List of articles of user 1">

    <div class="flex justify-end w-full mb-4">
        <a href="{{route('articles.create')}}" class="p-1 bg-teal-500 text-white rounded">Create new article</a>
    </div>

    @foreach($articles as $article)
        <div class="bg-white p-1 mb-1 flex flex-row justify-between">
            <h2 class="text-lg font-bold">{{$article->title}}</h2>
            <div class="flex gap-2 text-sm">
                <a href="{{route('articles.show', ['article' => $article->id])}}" class="text-blue-500">Details</a>
                <a href="{{route('articles.edit', ['article' => $article->id])}}" class="text-blue-500">Edit</a>

                <form action="{{route('articles.destroy', ['article' => $article->id])}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="text-blue-500">Delete</button>
                </form>

            </div>
        </div>
    @endforeach

</x-site-layout>
