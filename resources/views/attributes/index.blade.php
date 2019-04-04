@extends('layouts.main')

@section('content')
<div class="col-12">
    <div class="page-title">
        <h2 class="mb-4">
            {{ __('attributes.list_header_text') }}
            <small class="text-muted">@if(count($attributes) > 0) {{ count($attributes) }} @endif</small>
        </h2>
    </div>
    @if(session('responseMessages'))
        @foreach(session('responseMessages') as $status => $message)
            <div class="alert alert-{{ $status }} mb-3">
                {{ $message }}
            </div>
        @endforeach
    @endif
    @if(count($attributes) > 0)
    <table class="table">
        <thead>
        <tr>
            <th scope="col">{{ __('attributes.id_text') }}</th>
            <th>{{ __('attributes.name_field_label') }}</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            @each('attributes.item', $attributes, 'attribute')
        </tbody>
    </table>
    @else
    @include('attributes.empty')
    @endif
</div>
@endsection