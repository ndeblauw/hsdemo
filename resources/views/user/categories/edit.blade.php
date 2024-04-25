<x-site-layout title="Editing a category">

    @if($errors->any())
        <div class="bg-red-50 rounded p-2 text-red-500">
            {{ $errors->any() ? $errors : ''}}
        </div>
    @endif

    <form action="{{route('user.categories.update', ['category' => $category->id])}}" method="post" class="flex flex-col gap-4">
        @csrf
        @method('PUT')

        <x-form-text label="Name" name="name" value="{{$category->name}}"/>

        <div class="mt-4 flex justify-end">
            <button type="submit" class="p-1 bg-teal-500 text-white rounded">Update</button>
        </div>
    </form>

</x-site-layout>
