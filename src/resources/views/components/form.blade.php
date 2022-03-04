@props([
    'action',
    'method' => 'post',
])

<form
    accept-charset="UTF-8"
    action="{{ $action }}"
    enctype="multipart/form-data"
    method="{{ $method === 'get' ? 'get' : 'post' }}"
>
    @if($method !== 'get')
        @csrf
        @method($method)
    @endif

    {{ $slot }}
</form>
