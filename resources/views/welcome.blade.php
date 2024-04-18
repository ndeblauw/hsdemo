<x-site-layout title="Welcome">

    <h2 class="text-2xl font-bold">Welcome to the new blog</h2>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquid amet animi distinctio dolores eius eligendi fugit, illum impedit iusto modi natus obcaecati, pariatur placeat quaerat sed, similique sit temporibus.
    </p>

    <div class="grid grid-cols-2 gap-8">
        @foreach($articles as $article)
            <div class="p-2 bg-white rounded">
                <h3 class="font-bold text-xl">{{$article->title}}</h3>
                <div class="text-purple-500">Author: {{$article->author->name }}</div>
                <p>{{$article->content}}</p>
            </div>
        @endforeach
    </div>

</x-site-layout>
