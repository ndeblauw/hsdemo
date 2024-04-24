<x-site-layout title="Start writing an article">

    @if($errors->any())
        <div class="bg-red-50 rounded p-2 text-red-500">
            {{ $errors->any() ? $errors : ''}}
        </div>
    @endif

    <form action="{{route('user.articles.store')}}" method="post" class="flex flex-col gap-4">
        @csrf

        <x-form-text label="Title" name="title" />
        <x-form-textarea label="Article" name="content" rows="5"/>
        <x-form-checkboxes label="Categories" name="categories" :options="\App\Models\Category::orderBy('name')->pluck('name', 'id')->toArray()" />

        <div class="mt-4 flex justify-end">
            <button type="submit" class="p-1 bg-teal-500 text-white rounded">Create</button>
        </div>
    </form>

</x-site-layout>
