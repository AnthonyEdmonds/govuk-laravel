@props([
    'tasks' => [],
    'title',
])

@php
    use AnthonyEdmonds\GovukLaravel\Helpers\TaskList;
    use Illuminate\Support\Str;
    
    foreach ($tasks as $label => $details) {
        if (isset($details['colour']) === false) {
            $tasks[$label]['colour'] = TaskList::STATUSES[$details['status']] ?? null;
        }
        
        if (isset($details['id']) === false) {
            $tasks[$label]['id'] = Str::kebab($label);
        }
        
        if (isset($details['url']) === false) {
            $tasks[$label]['disabled'] = true;
            $tasks[$label]['item_classes'] = '';
            $tasks[$label]['status_classes'] = ' govuk-task-list__status--cannot-start-yet';
        } else {
            $tasks[$label]['disabled'] = false;
            $tasks[$label]['item_classes'] = ' govuk-task-list__item--with-link';
            $tasks[$label]['status_classes'] = '';
        }
    }
@endphp

<x-govuk::h2>{{ $title }}</x-govuk::h2>

<ul class="govuk-task-list">
    @foreach($tasks as $label => $details)
        <li class="govuk-task-list__item{{ $details['item_classes'] }}">
            <div class="govuk-task-list__name-and-hint">
                @if($details['disabled'] === true)
                    <span aria-describedby="{{ $details['id'] }}-status">{{ $label }}</span>
                @else
                    <a
                        class="govuk-link govuk-task-list__link"
                        href="{{ $details['url'] }}"
                        aria-describedby="{{ $details['id'] }}-status"
                    >{{ $label }}</a>
                @endif

                @isset($details['hint'])
                    <div id="{{ $details['id'] }}-hint" class="govuk-task-list__hint">
                        {{ $details['hint'] }}
                    </div>
                @endisset
            </div>
            
            <div
                class="govuk-task-list__status{{ $details['status_classes'] }}"
                id="{{ $details['id'] }}-status"
            >
                @isset($details['colour'])
                    <x-govuk::tag colour="{{ $details['colour'] }}" label="{{ $details['status'] }}" />
                @else
                    {{ $details['status'] }}    
                @endisset
            </div>
        </li>
    @endforeach
</ul>
