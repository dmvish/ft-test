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
        <form method="post" action="{{ route('attributes.update', ['attribute' => $attribute->id]) }}" class="needs-validation{{ $errors->edit->has('name') ? ' was-validated' : '' }}">
            @csrf
            {{ method_field('put') }}
            <div class="form-group">
                <label for="attribute-name">{{ __('attributes.name_field_label') }}</label>
                <input type="text" class="form-control{{ $errors->edit->has('name') ? ' is-invalid' : '' }}" value="{{ $attribute->name }}" name="name" id="attribute-name" placeholder="Enter attribute name" required="">
                @if ($errors->edit->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->edit->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">{{ __('common.save_button_text') }}</button>
            <a href="{{ route('attributes.delete', ['attribute' => $attribute->id]) }}" class="float-right text-danger">{{ __('common.delete_link_text') }}</a>
        </form>
    </div>
@endsection