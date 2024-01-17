<div class="my-4 bg-gray-200 p-4">


    <h2 class="font-bold text-2xl">Todo list for user {{$user?->name ?? 'guest'}}</h2>


    <form wire:submit="addTodo">
        <input wire:model.change="todo" type="text">
        <button type="submit">Add</button>
    </form>

    <ul class="list-disk pl-4">
    @foreach($todos as $index => $todo)
        <li>
            {{$todo}}
            <button wire:click="delete({{$index}})" class="bg-red-500 text-red-50 p-1 rounded-full text-xs">X</button>
        </li>
    @endforeach
    </ul>
</div>
