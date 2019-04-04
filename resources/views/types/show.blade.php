@extends('layouts.main')

@section('content')
    <div class="col-12">
        <strong>{{ __('types.name_field_label') }}:</strong>
        {{ $type->name}} | <a href="{{ route('types.edit', ['type' => $type->id]) }}" class="card-link">{{ __('common.edit_link_text') }}</a>
    </div>
@endsection