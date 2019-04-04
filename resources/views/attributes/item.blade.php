<tr>
    <th>{{ $attribute->id }}</th>
    <td>{{ $attribute->name }}</td>
    <td><a href="{{ route('attributes.show', ['attribute' => $attribute->id]) }}" class="card-link">{{ __('common.more_link_text') }}</a></td>
    <td><a href="{{ route('attributes.edit', ['attribute' => $attribute->id]) }}" class="card-link">{{ __('common.edit_link_text') }}</a></td>
</tr>