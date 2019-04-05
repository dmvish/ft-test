<form action="{{ route('products.index') }}" method="get">
    <input type="hidden" name="action" value="search" />
    <div class="form-row mb-3">
        <label for="attribute-name">{{ __('products.name_field_label') }}</label>
        <input type="text" class="form-control" name="name" value="@if(count($queryParams) > 0 && !empty($queryParams['name'])) {{ $queryParams['name'] }} @endif" placeholder="{{ __('products.name_field_label') }}">
    </div>

    <div class="attributes">
        @foreach($attributes as $index => $attr)
            <div class="form-row mb-3">
                <label for="attribute-name">{{ $attr->name }}</label>
                {{--<input type="hidden" name="attr[{{ $attr->id }}][id]" value="{{ $attr->id }}" />--}}
                <input type="text" class="form-control" name="attr[{{ $attr->id }}]" @if(count($queryParams) > 0 && !empty($queryParams['attr'][$attr->id])) value="{{ $queryParams['attr'][$attr->id] }}" @endif placeholder="{{ $attr->name }}">
            </div>
        @endforeach
    </div>
    <div class="form-row mb-3">
        <label for="attribute-name">{{ __('common.choose_sort_by') }}</label>
        <select class="custom-select" name="sort_by">
            <option value="created_at">{{ __('common.option_default') }}</option>
            @foreach(__('dbcolumns.products') as $fieldName => $fieldTitle)
                <option value="{{ $fieldName }}" @if(count($queryParams) > 0 && $fieldName == $queryParams['sort_by']) selected="selected" @endif>{{ $fieldTitle }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-row mb-3">
        <label for="attribute-name">{{ __('common.choose_order_by') }}</label>
        <select class="custom-select" name="order_by">
            <option value="desc">{{ __('common.option_default') }}</option>
            @foreach(__('common.orders') as $direction => $orderTitle)
                <option value="{{ $direction }}" @if(count($queryParams) > 0 && $direction == $queryParams['order_by']) selected="selected" @endif>{{ $orderTitle }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-row mb-3">
        <label for="attribute-name">{{ __('common.limit_field_title') }}</label>
        @php( $limit = (count($queryParams) > 0 && (int) $queryParams['limit'] > 0) ? (int) $queryParams['limit'] : 15 )
        <input type="number" class="form-control" name="limit" value="{{ $limit }}" placeholder="{{ __('common.limit_field_title') }}">
    </div>
    <div class="form-row mb-3">
        <div class="input-group flex-column">
            <div class="btn-group">
                <button class="btn btn-primary" type="submit" id="button-search">{{ __('common.search_button_title') }}</button>
                @if(count($queryParams) > 0)
                    <a class="btn btn-outline-primary" href="{{ route('products.index') }}">&times;</a>
                @endif
            </div>
        </div>
    </div>
</form>