<x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs"/>

<main>
    <h1>{{ $title }}</h1>

    <x-form-builder::description :description="$description"/>

    @forelse($summary as $task)
        <h2>
            <a href="{{ $task['link'] }}">{{ $task['label'] }}</a>
            <span class="{{ $task['colour'] }}">{{ $task['status'] }}</span>
        </h2>

        <ul>
            @forelse($task['questions'] as $question)
                <li>
                    <ul>
                        @forelse($question['fields'] as $label => $answer)
                            <li><b>{{ $label }}</b> {{ $answer }}</li>
                        @empty
                            <li>No fields have been added to this question.</li>
                        @endforelse
                    </ul>

                    <a href="{{ $question['link'] }}">Change</a>
                </li>
            @empty
                <li>No questions have been added to this task.</li>
            @endforelse
        </ul>
    @empty
        <p>No tasks have been added to this form.</p>
    @endforelse

    <form
        action="{{ $submit['link'] }}"
        enctype="multipart/form-data"
        method="POST"
    >
        @csrf
        @method('POST')

        <button>{{ $submit['label'] }}</button>
        @isset($draft)
            <button formaction="{{ $draft['link'] }}">{{ $draft['label'] }}</button>
        @endisset
    </form>

    <x-form-builder::actions :actions="$actions"/>
</main>
