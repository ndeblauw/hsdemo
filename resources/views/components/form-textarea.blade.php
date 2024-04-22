<label for="{{$name}}" class="w-full">
    <span class="text-sm font-semibold">{{$label}}</span><br/>
    <textarea id="{{$name}}" name="{{$name}}" rows="{{$rows}}"
           class="w-full @if($errors->has($name))border border-red-500 @endif">{{old($name,$value)}}</textarea>
    @error($name)<span class="text-red-500 text-xs">{{$message}}</span>@enderror
</label>
