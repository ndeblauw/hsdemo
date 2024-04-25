<x-site-layout title="List of categories used in application">

    @if( session('success_message') !== null)
        <div class="bg-green-50 text-green-500 p-2 rounded">
            {{session('success_message')}}
        </div>
    @endif

    <div class="flex justify-end w-full mb-4">
        <a href="{{route('user.categories.create')}}" class="p-1 bg-teal-500 text-white rounded">Create new category</a>
    </div>

    @foreach($categories as $category)
        <div class="bg-white p-1 mb-1 flex flex-row justify-between">
            <h2 class="text-lg font-bold">{{$category->name}}</h2>
            <div class="flex gap-2 text-sm">
                    <a href="{{route('user.categories.show', ['category' => $category->id])}}" class="text-blue-500">Details</a>

                    <a href="{{route('user.categories.edit', ['category' => $category->id])}}" class="text-blue-500">Edit</a>

                    <form action="{{route('user.categories.destroy', ['category' => $category->id])}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="text-blue-500">Delete</button>
                    </form>
            </div>
        </div>
    @endforeach

</x-site-layout>
