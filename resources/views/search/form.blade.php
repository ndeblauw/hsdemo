<x-site-layout title="Search your content">

    <form action="/search" method="POST">
        @csrf
        <x-form-text name="search" label="Search" />
        <div class="mt-4 flex justify-end">
            <button type="submit" class="p-1 bg-teal-500 text-white rounded">Search</button>
        </div>

    </form>

</x-site-layout>
