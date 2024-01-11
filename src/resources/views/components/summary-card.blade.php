@props([
    'actions' => [],
    'list',
    'noBorders' => false,
    'title',
    'id' => ''
])

<div class="govuk-summary-card" @if(empty($id) === false) id="{{ $id }}" @endif>
    <div class="govuk-summary-card__title-wrapper">
        <h2 class="govuk-summary-card__title">{{ $title }}</h2>
        <ul class="govuk-summary-card__actions">
            @foreach($actions as $label => $action)
                <li class="govuk-summary-card__action">
                    <a class="govuk-link" href="{{ $action['url'] ?? $action }}">
                        {{ $label }}
                        <span class="govuk-visually-hidden">
                            {{ $action['hidden'] ?? '' }}
                            {{ $title }}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    
    <div class="govuk-summary-card__content">
        <x-govuk::summary-list
            :list="$list"
            :no-borders="$noBorders"
        />
    </div>
</div>
