@if(isset($hideTitle) === true && $hideTitle === true)
@else
    <x-govuk::h1>{{ $title }}</x-govuk::h1>
@endisset
