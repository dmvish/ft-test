@extends('layouts.main')

@section('content')
    <div class="col-12">
        <div class="page-title">
            <h2 class="mb-4">
                {{ __('types.new_item_text') }}
            </h2>
        </div>
        @if (session('responseMessages'))
            @foreach(session('responseMessages') as $status => $message)
                <div class="alert alert-{{ $status }} mb-3">
                    {{ $message }}
                </div>
            @endforeach
        @endif
        <form method="post" action="{{ route('types.store') }}" class="needs-validation{{ $errors->store->has('name') ? ' was-validated' : '' }}">
            @csrf
            <div class="form-group">
                <label for="type-name">{{ __('types.name_field_label') }}</label>
                <input type="text" class="form-control{{ $errors->store->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" name="name" id="type-name" required="">
                @if ($errors->store->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->store->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">{{ __('common.create_button_text') }}</button>
        </form>
    </div>
@endsection