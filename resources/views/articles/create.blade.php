<x-site-layout title="Start writing an article">

    <div class="bg-red-50 rounded p-2 text-red-500">
        {{ $errors->any() ? $errors : ''}}
    </div>

    <form action="{{route('articles.store')}}" method="post"
          class="flex flex-col gap-4">
        @csrf

        <x-form-text label="Title" name="title" />
        
        <label for="content" class="w-full">
            Article:<br/>
            <textarea id="content" name="content"
                      class="w-full @if($errors->has('content'))border border-red-500 @endif"
                      rows="5">{{old('content')}}</textarea>
            @error('content')<span class="text-red-500 text-xs">{{$message}}</span>@enderror

        </label>


        <div>
            <button type="submit" class="p-1 bg-teal-500 text-white rounded">Create</button>
        </div>

    </form>

</x-site-layout>
