@impersonating
    <x-govuk::phase-banner phase="Impersonating">
        You are currently impersonating {{ \Illuminate\Support\Facades\Auth::user()->name }}.
        <x-govuk::a href="{{ route('admin.impersonate.leave') }}">Press here to leave impersonation</x-govuk::a>.
    </x-govuk::phase-banner>
@endImpersonating
