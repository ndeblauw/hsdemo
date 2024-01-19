<x-site-layout title="ADMIN ZONE - CATEGORIES">
    <a class="underline" href="{{route('admin.categories.index')}}">Back to the index</a>


    <x-crud-message/>


    <p class="font-bold">
        {{$category->name}}
    </p>

    <a class="underline" href="{{route('admin.categories.edit', $category)}}">Edit</a>

    <form action="{{route('admin.categories.destroy', $category)}}" method="post">
        @csrf
        @method('DELETE')
        <button class="underline">Delete</button>
    </form>


</x-site-layout>
