<x-site-layout title="List of articles of user {{auth()->user()->name}}">

    <div class="flex justify-end w-full mb-4">
        @if(auth()->user()->superadmin)
            <a href="{{route('user.categories.index')}}" class="mr-4 p-1 bg-indigo-400 text-white rounded">Manage categories</a>
        @endif
        <a href="{{route('user.articles.create')}}" class="p-1 bg-teal-500 text-white rounded">Create new article</a>
    </div>

    @foreach($articles as $article)
        <div class="bg-white p-1 mb-1 flex flex-row justify-between">
            <h2 class="text-lg font-bold">{{$article->title}}</h2>
            <div class="flex gap-2 text-sm">
                @if( $article->isAllowedToEdit(auth()->user()) )
                    <a href="{{route('user.articles.show', ['article' => $article->id])}}" class="text-blue-500">Details</a>
                    <a href="{{route('user.articles.edit', ['article' => $article->id])}}" class="text-blue-500">Edit</a>

                    <form action="{{route('user.articles.destroy', ['article' => $article->id])}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="text-blue-500">Delete</button>
                    </form>
                @else
                    You have no access!
                @endif

            </div>
        </div>
    @endforeach

</x-site-layout>
