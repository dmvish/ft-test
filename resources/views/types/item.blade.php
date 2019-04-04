<tr>
    <th>{{ $type->id }}</th>
    <td>{{ $type->name }}</td>
    <td><a href="{{ route('types.show', ['type' => $type->id]) }}" class="card-link">{{ __('common.more_link_text') }}</a></td>
    <td><a href="{{ route('types.edit', ['type' => $type->id]) }}" class="card-link">{{ __('common.edit_link_text') }}</a></td>
</tr>