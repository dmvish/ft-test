<div class="navbar mb-5">
    <div class="container d-flex flex-column flex-md-row justify-content-center">
        <a class="py-2 px-3 d-inline-block" href="{{ route('products.create') }}">{{ __('nav.header.add_product') }}</a>
        <a class="py-2 px-3 d-inline-block" href="{{ route('types.create') }}">{{ __('nav.header.add_type') }}</a>
        <a class="py-2 px-3 d-inline-block" href="{{ route('attributes.create') }}">{{ __('nav.header.add_attribute') }}</a>
    </div>
</div>