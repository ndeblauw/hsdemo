<x-site-layout title="Create new post">

    <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">

        @csrf

        <x-crud-input-field name="title" label="Title" placeholder="..."/>

        <br/>

        <x-crud-textarea name="body" label="Your post" placeholder="Just start typing" />

        <br/>
        <label for="file">File</label>
        <input name="image" type="file" />

        <br/>

        <button type="submit">Create</button>
    </form>

</x-site-layout>
