@extends('layouts.main')

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

            <button type="submit" class="btn btn-primary">{{ __('common.save_button_text') }}</button>
            <a href="{{ route('products.delete', ['product' => $product->id]) }}" class="float-right text-danger">{{ __('common.delete_link_text') }}</a>
        </form>
    </div>
@endsection