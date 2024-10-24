<!DOCTYPE html>
<html lang="en" class="govuk-template ">
    @include('govuk::layout.head')
    @include('govuk::parts.content')

    @php
        $hasAside = \Illuminate\Support\Facades\View::hasSection('aside');
    @endphp
    
    <body class="govuk-template__body">
        <script>document.body.className += ' js-enabled' + ('noModule' in HTMLScriptElement.prototype ? ' govuk-frontend-supported' : '');</script>

        <x-govuk::skip-link />

        @include('govuk::layout.header')

        <div class="govuk-width-container ">
            @include('govuk::parts.testing')
            @include('govuk::parts.impersonation')
            @include('govuk::parts.breadcrumbs')
            @include('govuk::parts.back')
            
            <main class="govuk-main-wrapper" id="content">
                <div class="govuk-grid-row">
                    <div class="govuk-grid-column-full">
                        @yield('heading')
                        @include('govuk::parts.flash')
                        @include('govuk::parts.errors')
                    </div>
                </div>
                
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
    </body>
</html>
