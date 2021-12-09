@props([
    'list',
    'noBorders' => false,
])

<dl class="govuk-summary-list">
    @foreach($list as $key => $values)
        <div class="govuk-summary-list__row">
            <dt class="govuk-summary-list__key">
                Name
            </dt>
            <dd class="govuk-summary-list__value">
                Sarah Philips
            </dd>
            <dd class="govuk-summary-list__actions">
                <a class="govuk-link" href="#">
                    Change<span class="govuk-visually-hidden"> name</span>
                </a>
            </dd>
        </div>
    @endforeach
</dl>
