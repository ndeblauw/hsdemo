<x-site-layout title="List of categories">

    <ul class="list-disc ml-5">
        @foreach($categories as $category)
            <li>
                <a class="underline hover:bg-purple-200" href="/categories/{{$category->id}}">
                    {{ $category->name }}
                </a>
            </li>
        @endforeach
    </ul>

</x-site-layout>

