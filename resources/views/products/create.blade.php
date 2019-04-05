@extends('layouts.main')

@push('scripts')
    <script src="{{ asset('public/js/products.js') }}"></script>
@endpush

@section('content')
    <div class="col-12">
        <div class="page-title">
            <h2 class="mb-4">
                {{ __('products.new_item_text') }}
            </h2>
        </div>
        @include('partials.response')
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
            <div class="form-group row align-items-center">
                <div class="col-2">
                    <label for="product-image">{{ __('products.image_field_label') }}</label>
                </div>
                <div class="col-5">
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
            <div class="form-group row align-items-center">
                <div class="col-2">
                    <label for="product-description">{{ __('products.type_field_label') }}</label>
                </div>
                <div class="col-5">
                    <select class="custom-select" name="type_id" id="product-type">
                        @foreach($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->store->has('type_id'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->store->first('type_id') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-2">
                    <label for="product-description">{{ __('products.attributes_field_label') }}</label>
                </div>
                <div class="col-5">
                    <button type="button" class="btn btn-sm btn-outline-primary" data-attr-add>{{ __('products.add_attribute') }}</button>
                </div>
            </div>
            <div data-attr-list></div>
            <div class="form-group row align-items-center d-none" data-attr-temp>
                <div class="col-2"></div>
                <div class="col-5">
                    <select class="custom-select" name="_id" id="product-attr">
                        @foreach($attributes as $attribute)
                            <option value="{{ $attribute->id }}">{{ $attribute->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <input type="text" class="form-control{{ $errors->store->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" name="_value" id="product-name">
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-sm btn-outline-danger" data-attr-remove>&times;</button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('common.create_button_text') }}</button>
        </form>
    </div>
@endsection