@extends('layouts.main')

@section('content')
<div class="col-12">
    <div class="page-title">
        <h2 class="mb-4">
            {{ __('types.list_header_text') }}
            <small class="text-muted">@if(count($types) > 0) {{ count($types) }} @endif</small>
        </h2>
    </div>
    @if(session('responseMessages'))
        @foreach(session('responseMessages') as $status => $message)
            <div class="alert alert-{{ $status }} mb-3">
                {{ $message }}
            </div>
        @endforeach
    @endif
    @if(count($types) > 0)
    <table class="table">
        <thead>
        <tr>
            <th scope="col">{{ __('types.id_text') }}</th>
            <th>{{ __('types.name_field_label') }}</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            @each('types.item', $types, 'type')
        </tbody>
    </table>
    @else
    @include('types.empty')
    @endif
</div>
@endsection