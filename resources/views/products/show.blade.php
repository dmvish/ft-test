@extends('layouts.main')

@section('content')
    <div class="col-12">
        <div class="card mb-3">
            <div class="row no-gutters">
                @if($product->image)
                    <div class="col-4">
                        <img src="{{ '/public'.Storage::url($product->image) }}" class="card-img" alt="{{ $product->name }}">
                    </div>
                @endif
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        @if($product->description)
                        <p class="card-text">{{ $product->description }}</p>
                        @endif
                        <p class="card-text">
                            <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="card-link">{{ __('common.edit_link_text') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection