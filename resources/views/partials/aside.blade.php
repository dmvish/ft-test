<div class="nav nav-pills flex-column">
    <ul class="list-unstyled" data-nav="" data-split="1" data-active="{{ Route::currentRouteName() }}">
        <li id="products"><a class="nav-link" href="{{ route('products.index') }}">{{ __('nav.aside.products') }}</a></li>
        <li id="types"><a class="nav-link" href="{{ route('types.index') }}">{{ __('nav.aside.types') }}</a></li>
        <li id="attributes"><a class="nav-link" href="{{ route('attributes.index') }}">{{ __('nav.aside.attributes') }}</a></li>
    </ul>
</div>

@yield('aside')