<div class="col-6">
<div class="card mb-3 shadow-sm">
    @if($product->image)
        <img src="{{ '/public'.Storage::url($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
    @endif
    <div class="card-body">
        <h5 class="card-title"><a href="{{ route('products.show', ['product' => $product->id]) }}">{{ $product->name }}</a></h5>
        @if($product->description)
        <p class="card-text">{{ $product->description }}</p>
        @endif
        <a href="{{ route('products.show', ['product' => $product->id]) }}" class="card-link">{{ __('common.more_link_text') }}</a>
        <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="card-link">{{ __('common.edit_link_text') }}</a>
    </div>
</div>
</div>
