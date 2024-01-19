<div class="p-4 bg-yellow-200 mb-6">
    <h2 class="font-bold">Weather information for {{$city}}
        <button wire:click="$toggle('showChangeCityForm')" class="font-normal text-xs p-1 bg-yellow-100 text-yellow-600">Change city</button>
    </h2>

    @if($showChangeCityForm)
        <form wire:submit.prevent="setCity" class="flex">
            <input type="text" wire:model="city" class="flex-1 border border-gray-400 p-2 mr-2">
            <button type="submit" class="p-2 bg-yellow-400 text-white">Get weather</button>
        </form>
    @endif

    <div class="flex justify-between">
        <div>{{$temperature}} °C</div>
        <div>{{$description}}</div>
    </div>
</div>
