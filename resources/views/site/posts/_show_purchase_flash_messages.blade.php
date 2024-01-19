@if( session()->has('purchase_success'))
    <div class="w-full bg-green-600 text-green-50 p-4 rounded my-4">
        {{ session()->get('purchase_success') }}
    </div>
@endif

@if( session()->has('purchase_pending'))
    <div class="w-full bg-yellow-600 text-yellow-50 p-4 rounded my-4">
        {{ session()->get('purchase_pending') }}
    </div>
@endif
