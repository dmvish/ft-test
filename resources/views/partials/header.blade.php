<div class="navbar mb-5">
    <div class="container justify-content-center nav nav-pills">
        <ul class="list-unstyled list-inline" data-nav="" data-split="0" data-active="{{ Route::currentRouteName() }}">
            <li class="list-inline-item" id="products_create"><a class="nav-link py-2 px-3" href="{{ route('products.create') }}">{{ __('nav.header.add_product') }}</a></li>
            <li class="list-inline-item" id="types_create"><a class="nav-link py-2 px-3" href="{{ route('types.create') }}">{{ __('nav.header.add_type') }}</a></li>
            <li class="list-inline-item" id="attributes_create"><a class="nav-link py-2 px-3" href="{{ route('attributes.create') }}">{{ __('nav.header.add_attribute') }}</a></li>
        </ul>
    </div>
</div>

{{--  --}}