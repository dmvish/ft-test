@extends('layouts.main')

@section('content')
    <div class="col-12">
        <strong>{{ __('attributes.name_field_label') }}:</strong>
        {{ $attribute->name}} | <a href="{{ route('attributes.edit', ['attribute' => $attribute->id]) }}" class="card-link">{{ __('common.edit_link_text') }}</a>
    </div>
@endsection