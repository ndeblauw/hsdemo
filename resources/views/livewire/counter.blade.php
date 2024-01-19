<div>
    @if($show_counter)
        <div class="w-full flex justify-center text-3xl">{{$counter}}</div>
        <div class="flex justify-between gap-x-4">
            <button wire:click="increment()" class="w-1/3 bg-red-300 text-red-600 p-2 rounded hover:bg-red-200">+ {{$amount}}</button>

            <input type="text" wire:model.live.debounce.3000="amount" class="w-1/3 text-center text-black"/>

            <button wire:click.throttle.1000="decrement()" class="w-1/3 bg-red-300 text-red-600 p-2 rounded hover:bg-red-200">- {{$amount}}</button>
        </div>
    @else
        <button wire:click="$toggle('show_counter')" class="bg-red-300 text-red-600 p-2 rounded hover:bg-red-200">Show counter</button>
    @endif
</div>
