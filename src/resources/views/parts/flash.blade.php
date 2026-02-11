@if(config('govuk.parts.laracasts_flash') === true)
    @foreach (session('flash_notification', collect())->toArray() as $message)
        @php
            switch ($message['level']) {
                case 'danger':
                    $colour = 'error';
                    $title = 'Error';
                    break;

                case 'success':
                    $colour = 'success';
                    $title = 'Success';
                    break;

                case 'warning':
                    $colour = 'warning';
                    $title = 'Warning';
                    break;

                default:
                    $colour = 'info';
                    $title = 'Information';
            }
        @endphp

        <x-govuk::notification-banner :title="$title" :colour="$colour">
            <p class="govuk-body">{!! $message['message'] !!}</p>
        </x-govuk::notification-banner>
    @endforeach

    {{ session()->forget('flash_notification') }}
@endif
