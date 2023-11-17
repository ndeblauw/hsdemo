<x-site-layout title="Categories">

    <ul class="grid grid-cols-4 gap-4">
    @foreach($categories as $category)
        <li class="block p-2 bg-white">
            <a href="{{route('categories.show', ['id' => $category->id])}}">
                {{$category->name}}
            </a>
        </li>
    @endforeach
    </ul>

</x-site-layout>
