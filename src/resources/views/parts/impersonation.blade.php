@impersonating
    <x-phase-banner phase="Impersonating">
        You are currently impersonating {{ \Illuminate\Support\Facades\Auth::user()->name }}.
        <x-a href="{{ route('admin.impersonate.leave') }}">Press here to leave impersonation</x-a>.
    </x-phase-banner>
@endImpersonating
