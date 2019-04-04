@extends('layouts.main')

@section('content')
<div class="col-12">
    <div class="page-title">
        <h2 class="mb-4">
            {{ __('products.list_header_text') }}
            <small class="text-muted">@if(count($products) > 0) {{ count($products) }} @endif</small>
        </h2>
    </div>
    @if (session('responseMessages'))
        @foreach(session('responseMessages') as $status => $message)
            <div class="alert alert-{{ $status }} mb-3">
                {{ $message }}
            </div>
        @endforeach
    @endif
    <div class="row">
        @each('products.item', $products, 'product', 'products.empty')
    </div>
    {{ $products->appends($queryParams)->links() }}
</div>
@endsection