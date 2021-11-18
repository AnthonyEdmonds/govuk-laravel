@extends('layout.govuk')

@php
    // Each of these parameters are optional - use them where needed
    $back = route('where-to-go-back-to');
    $breadcrumbs = [
        'Label of link' => route('the-route'),
    ];
    $caption = 'Section / stage indicator (optional)';
    $title = 'Section title or question';
    $hideTitle = true;
@endphp

@section('content')
    // Main content
@endsection

@section('aside')
    // Related content
@endsection
