@extends('layouts.main')

@section('content')
    <div class="col-12">
        <div class="page-title">
            <h2 class="mb-4">
                {{ __('products.new_item_text') }}
            </h2>
        </div>
        @if (session('responseMessages'))
            @foreach(session('responseMessages') as $status => $message)
                <div class="alert alert-{{ $status }} mb-3">
                    {{ $message }}
                </div>
            @endforeach
        @endif
        <form method="post" action="{{ route('products.store') }}" class="needs-validation{{ $errors->store->has('name') ? ' was-validated' : '' }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product-name">{{ __('products.name_field_label') }}</label>
                <input type="text" class="form-control{{ $errors->store->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" name="name" id="product-name" required="">
                @if ($errors->store->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->store->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="product-description">{{ __('products.description_field_label') }}</label>
                <textarea class="form-control{{ $errors->store->has('description') ? ' is-invalid' : '' }}" name="description" id="product-description" rows="5">{{ old('description') }}</textarea>
                @if ($errors->store->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->store->first('description') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <label for="product-image">{{ __('products.image_field_label') }}</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="product-image" name="image">
                            <label class="custom-file-label" for="product-image">{{ __('products.image_choose_label') }}</label>
                        </div>
                        @if ($errors->store->has('image'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->store->first('image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('common.create_button_text') }}</button>
        </form>
    </div>
@endsection