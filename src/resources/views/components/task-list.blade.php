@props([
    'list',
])

@php
    foreach ($list as $title => $items) {
        foreach ($items as $label => $details) {
            $list[$title][$label]['colour'] = \AnthonyEdmonds\GovukLaravel\Helpers\TaskList::STATUSES[$details['status']];
            $list[$title][$label]['id'] = \Illuminate\Support\Str::snake($label);
        }
    }
@endphp

<ol class="app-task-list">
    @foreach($list as $title => $items)
        <li>
            <h2 class="app-task-list__section">
                <span class="app-task-list__section-number">{{ $loop->iteration }}. </span> {{ $title }}
            </h2>
            
            <ul class="app-task-list__items">
                @foreach($items as $label => $details)
                    <li class="app-task-list__item">
                        <span class="app-task-list__task-name">
                            <x-govuk::a
                                href="{{ $details['url'] }}"
                                aria-describedby="{{ $details['id'] }}"
                            >{{ $label }}</x-govuk::a>
                        </span>
                        
                        <x-govuk::tag
                            colour="{{ $details['colour'] }}"
                            id="{{ $details['id'] }}"
                            label="{{ $details['status'] }}"
                            task-list
                        />
                    </li>
                @endforeach
            </ul>
        </li>
    @endforeach
</ol>
