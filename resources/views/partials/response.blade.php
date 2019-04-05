@if (session('responseMessages'))
    @foreach(session('responseMessages') as $response)
        <div class="alert alert-{{ $response['status'] }} mb-3">
            {{ $response['message'] }}
        </div>
    @endforeach
@endif