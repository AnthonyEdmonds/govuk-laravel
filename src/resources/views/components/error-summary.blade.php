@props([
    'messages',
    'title' => 'There is a problem',
])

@use(AnthonyEdmonds\GovukLaravel\Helpers\GovukPage)

<div
    class="govuk-error-summary"
    aria-labelledby="error-summary-title"
    role="alert"
    data-module="govuk-error-summary"
>
    <h2 class="govuk-error-summary__title" id="error-summary-title">
        {{ $title }}
    </h2>

    <div class="govuk-error-summary__body">
        <ul class="govuk-list govuk-error-summary__list">
            @foreach($messages as $id => $message)
                <li>
                    <a href="#{{ GovukPage::dotsToBrackets($id) }}">{{ $message }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
