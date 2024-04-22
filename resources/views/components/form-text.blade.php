<label for="{{$name}}" class="w-full">
    <span class="text-sm font-semibold">{{$label}}</span><br/>
    <input type="text" id="{{$name}}" value="{{old($name,$value)}}" name="{{$name}}"
           class="@if($errors->has($name))border border-red-500 @endif"
    />
    @error($name)<span class="text-red-500 text-xs">{{$message}}</span>@enderror
</label>
