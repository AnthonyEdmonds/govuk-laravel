@foreach (session('flash_notification', collect())->toArray() as $message)
    @php
        switch ($message['level']) {
            case 'danger':
                $colour = 'nr-red';
                $title = 'Error';
                break;

            case 'success':
                $colour = 'nr-green';
                $title = 'Success';
                break;

            case 'warning':
                $colour = 'nr-gold';
                $title = 'Warning';
                break;

            default:
                $colour = 'nr-blue';
                $title = 'Information';
        }
    @endphp

    <x-govuk::notification-banner :title="$title" :colour="$colour">
        <p class="govuk-body">{{ $message['message'] }}</p>
    </x-govuk::notification-banner>
@endforeach

{{ session()->forget('flash_notification') }}
