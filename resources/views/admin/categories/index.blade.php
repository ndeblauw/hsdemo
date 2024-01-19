<x-site-layout title="ADMIN ZONE - CATEGORIES">
    <a class="underline" href="{{route('admin.categories.create')}}">Create a category</a>

    <hr/><br/>

    <x-crud-message/>

    <ul>
        @foreach($categories as $category)
            <li>
                {{$category->name}} -
                <a class="underline" href="{{route('admin.categories.show', $category)}}">show</a>
                <a class="underline" href="{{route('admin.categories.edit', $category)}}">edit</a>
            </li>
        @endforeach
    </ul>

</x-site-layout>
