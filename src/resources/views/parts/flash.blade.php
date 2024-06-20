@if(config('govuk.parts.laracasts_flash') === true)
    @foreach (session('flash_notification', collect())->toArray() as $message)
        @php
            switch ($message['level']) {
                case 'danger':
                    $colour = 'red';
                    $title = 'Error';
                    break;

                case 'success':
                    $colour = 'green';
                    $title = 'Success';
                    break;

                case 'warning':
                    $colour = 'yellow';
                    $title = 'Warning';
                    break;

                default:
                    $colour = 'blue';
                    $title = 'Information';
            }
        @endphp

        <x-govuk::notification-banner :title="$title" :colour="$colour">
            <p class="govuk-body">{!! $message['message'] !!}</p>
        </x-govuk::notification-banner>
    @endforeach

    {{ session()->forget('flash_notification') }}
@endif
