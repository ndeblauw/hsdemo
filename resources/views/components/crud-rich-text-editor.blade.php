<label>
    <div class="text-xs font-semibold uppercase mb-1">{{$label}}</div>
    <textarea class="tinymce" name="{{$name}}" placeholder="{{$placeholder}}">{{old($name, $value)}}</textarea>
</label>
<x-crud-error-message field="{{$name}}"/>

{{-- Downloaded from https://www.tiny.cloud/get-tiny/ (Open Source Community download link) --}}
<script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
<script>
    var editor_config = {
        relative_urls : false,
        path_absolute: "{{config('app.url')}}",
        selector: '.tinymce',
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor',
            'searchreplace visualblocks fullscreen',
            'contextmenu paste help wordcount code'
        ],
        toolbar: ' undo redo |  bold italic formatselect | link | alignleft aligncenter alignright alignjustify | numlist bullist | outdent indent | removeformat | code | help',
        block_formats: 'Paragraph=p;Heading 2=h2;Heading 3=h3;',
    }
    tinymce.init(editor_config);
</script>
