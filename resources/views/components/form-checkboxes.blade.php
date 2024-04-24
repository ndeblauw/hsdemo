<div>
    <div class="text-sm font-semibold">{{$label}}</div>
    <div class="grid grid-cols-6 gap-4">
        @foreach($options as $key => $option)
            <div>
                <input name="{{$name}}[]" type="checkbox" id="option-{{$loop->index}}" value="{{$key}}" @checked( $values->pluck('id')->contains($key) )/>
                <label for="option-{{$loop->index}}">{{$option}}</label><br>
            </div>
        @endforeach
    </div>
</div>
