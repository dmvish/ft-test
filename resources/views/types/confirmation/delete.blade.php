@extends('layouts.main')

@section('content')
    <div class="col-6 offset-3">
        <div class="card">
            <div class="card-header">
                <span class="text-muted">
                    {{ __('types.action_delete_q') }}
                </span>
            </div>
            <div class="card-body">
                <div class="flex pb-3">
                    <strong class="item-name">{{ $type->name }}</strong>
                </div>
                <form action="{{ route('types.destroy', ['type' => $type->id]) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-primary">{{ __('common.delete_button_title') }}</button>
                    <a href="{{ route('types.edit', ['type' => $type->id]) }}" title="{{ __('common.cancel_button_title') }}" class="btn btn-link ml-2">{{ __('common.cancel_button_title') }}</a>
                </form>
            </div>
        </div>
    </div>
@endsection