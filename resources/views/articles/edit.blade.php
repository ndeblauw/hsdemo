<x-site-layout title="Editing an article">

    @if($errors->any())
        <div class="bg-red-50 rounded p-2 text-red-500">
            {{ $errors->any() ? $errors : ''}}
        </div>
    @endif

    <form action="{{route('articles.update', ['article' => $article->id])}}" method="post"
          class="flex flex-col gap-4">
        @csrf
        @method('PUT')

        <x-form-text label="Title" name="title" value="{{$article->title}}"/>

        <label for="content" class="w-full">
            Article:<br/>
            <textarea id="content" name="content"
                     class="w-full @if($errors->has('content'))border border-red-500 @endif"
                      rows="5">{{old('content',$article->content)}}</textarea>
            @error('content')<span class="text-red-500 text-xs">{{$message}}</span>@enderror

        </label>

        <x-form-text label="User id" name="user_id" value="{{$article->user_id}}"/>

        <div>
            <button type="submit" class="p-1 bg-teal-500 text-white rounded">Update</button>
        </div>

    </form>

</x-site-layout>
