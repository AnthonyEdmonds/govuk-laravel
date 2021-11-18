@if(App::environment('production') !== true)
    <x-phase-banner phase="testing">
        You are currently accessing a testing environment
    </x-phase-banner>
@endif
