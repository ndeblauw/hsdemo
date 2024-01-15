<div class="bg-red-500 text-white p-8">
    Hello world, the time is {{ now()->format('H:i:s') }}<br/>

    <button wire:click.window="$refresh" class="bg-red-300 text-red-600 p-2 rounded hover:bg-red-200">Refresh</button>

    <livewire:counter/>

    <livewire:counter/>


</div>
