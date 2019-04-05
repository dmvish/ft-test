@extends('layouts.main')

@section('aside')
    @include('partials.search')
@endsection

@section('content')
    <div class="col-12">
        <div class="page-title">
            <h2 class="mb-4">
                {{ __('products.list_header_text') }}
                <small class="text-muted">@if(count($products) > 0) {{ count($products) }} @endif</small>
            </h2>
        </div>
        @if (session('responseMessages'))
            @foreach(session('responseMessages') as $response)
                <div class="alert alert-{{ $response['status'] }} mb-3">
                    {{ $response['message'] }}
                </div>
            @endforeach
        @endif
        <div class="row">
            @each('products.item', $products, 'product', 'products.empty')
        </div>
        {{ $products->appends($queryParams)->links() }}
    </div>
@endsection