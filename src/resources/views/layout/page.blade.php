<!DOCTYPE html>
<html lang="en" class="govuk-template ">
    @include('govuk::layout.head')
    @include('govuk::parts.content')

    @php
        $hasAside = \Illuminate\Support\Facades\View::hasSection('aside');
    @endphp
    
    <body class="govuk-template__body">
        <script>
            document.body.className = ((document.body.className) ? document.body.className + ' js-enabled' : 'js-enabled');
        </script>

        <x-govuk::skip-link />

        @include('govuk::layout.header')

        <div class="govuk-width-container ">
            @include('govuk::parts.testing')
            @include('govuk::parts.impersonation')
            @yield('heading')
            @include('govuk::parts.breadcrumbs')
            @include('govuk::parts.back')
            @include('govuk::parts.flash')
            @include('govuk::parts.errors')

            <main class="govuk-main-wrapper " id="content" role="main">
                <div class="govuk-grid-row">
                    <div class="{{ $hasAside === true ? 'govuk-grid-column-two-thirds' : 'govuk-grid-column-full' }}">
                        @include('govuk::parts.caption')
                        @include('govuk::parts.title')
                        @yield('before-main')
                        @yield('main')
                        @yield('after-main')
                    </div>

                    @if($hasAside === true)
                        <aside class="govuk-grid-column-one-third">
                            @yield('aside')
                        </aside>
                    @endif
                </div>
            </main>
        </div>

        @include('govuk::layout.footer')
        @include('govuk::layout.foot')
    </body>
</html>
