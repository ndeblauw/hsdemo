<x-site-layout title="{{$category->name}}">

    <div class="flex justify-center w-full mb-4 gap-4">
        <a href="{{route('user.categories.index')}}" class="p-1 bg-teal-500 text-white rounded">Back to index</a>

        <a href="{{route('user.categories.edit', ['category' => $category->id])}}" class="p-1 bg-teal-500 text-white rounded">edit</a>
    </div>

    @if( session('success_message') !== null)
        <div class="bg-green-50 text-green-500 p-2 rounded">
            {{session('success_message')}}
        </div>
    @endif

    <h2 class="font-bold text-xl">List of articles using this catehgory</h2>
    <ul class="list-disc ml-5">
        @foreach($category->articles as $article)
            <li>{{$article->title}}</li>
        @endforeach
    </ul>

</x-site-layout>


