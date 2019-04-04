@extends('layouts.main')

@push('scripts')
    <script src="{{ asset('public/js/products.js') }}"></script>
@endpush

@section('content')
    <div class="col-12">
        <div class="page-title">
            <h2 class="mb-4">
                {{ __('common.editing_link_text') }}
            </h2>
        </div>
        @if (session('responseMessages'))
            @foreach(session('responseMessages') as $status => $message)
                <div class="alert alert-{{ $status }} mb-3">
                    {{ $message }}
                </div>
            @endforeach
        @endif
        <form method="post" action="{{ route('products.update', ['product' => $product->id]) }}" class="needs-validation{{ $errors->edit->has('name') ? ' was-validated' : '' }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('put') }}
            <div class="form-group">
                <label for="product-name">{{ __('products.name_field_label') }}</label>
                <input type="text" class="form-control{{ $errors->edit->has('name') ? ' is-invalid' : '' }}" value="{{ $product->name }}" name="name" id="product-name" placeholder="Enter product name" required="">
                @if ($errors->edit->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->edit->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="product-description">{{ __('products.description_field_label') }}</label>
                <textarea class="form-control{{ $errors->edit->has('description') ? ' is-invalid' : '' }}" name="description" id="product-description" rows="5">{{ $product->description }}</textarea>
                @if ($errors->edit->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->edit->first('description') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <div class="row">
                    @if($product->image)
                    <div class="col-3">
                        <img src="{{ '/public'.Storage::url($product->image) }}" class="img-thumbnail" alt="{{ $product->name }}">
                    </div>
                    @endif
                    <div class="col-6">
                        <label for="product-image">{{ __('products.image_field_label') }}</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="product-image" name="image">
                            <label class="custom-file-label" for="product-image">{{ __('products.image_choose_label') }}</label>
                        </div>
                        @if ($errors->edit->has('image'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->edit->first('image') }}</strong>
                            </span>
                        @endif
                        <div class="custom-control custom-checkbox mt-3">
                            <input type="checkbox" class="custom-control-input" id="delete" name="delete" value="1">
                            <label class="custom-control-label" for="delete">{{ __('products.image_delete_field_label') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-2">
                    <label for="product-description">{{ __('products.type_field_label') }}</label>
                </div>
                <div class="col-5">
                    <select class="custom-select" name="type_id" id="product-type">
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" @if($product->type_id == $type->id) selected="selected" @endif>{{ $type->name}}</option>
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
            <div data-attr-list>
                @foreach($product->attributes as $index => $attr)
                    <div class="form-group row align-items-center _attr-item" id="item{{ $index }}">
                        <div class="col-2"></div>
                        <div class="col-5">
                            <select class="custom-select" name="attributes[{{ $attr['id'] }}][id]" id="product-attr">
                                @foreach($attributes as $attribute)
                                    <option value="{{ $attribute->id }}" @if($attr->pivot->attribute_id == $attribute->id) selected="selected" @endif>{{ $attribute->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control{{ $errors->store->has('name') ? ' is-invalid' : '' }}" value="{{ $attr->pivot->value }}" name="attributes[{{ $attr['id'] }}][value]" id="product-name">
                        </div>
                        <div class="col-1">
                            <button type="button" class="btn btn-sm btn-outline-danger" data-attr-remove="#item{{ $index }}">&times;</button>
                        </div>
                    </div>
                @endforeach
            </div>
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
            <button type="submit" class="btn btn-primary">{{ __('common.save_button_text') }}</button>
            <a href="{{ route('products.delete', ['product' => $product->id]) }}" class="float-right text-danger">{{ __('common.delete_link_text') }}</a>
        </form>
    </div>
@endsection