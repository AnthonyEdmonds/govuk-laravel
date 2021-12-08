<!DOCTYPE html>
<html lang="en" class="govuk-template ">
    @include('govuk::layout.head')
    @include('govuk::parts.content')

    <body class="govuk-template__body">
        <script>
            document.body.className = ((document.body.className) ? document.body.className + ' js-enabled' : 'js-enabled');
        </script>

        <a href="#main-content" class="govuk-skip-link">Skip to main content</a>

        @include('govuk::layout.header')

        <div class="govuk-width-container ">
            @include('govuk::parts.testing')
            @include('govuk::parts.impersonation')
            @yield('heading')
            @include('govuk::parts.breadcrumbs')
            @include('govuk::parts.back')
            @include('flash::message')
            @include('govuk::parts.errors')

            <main class="govuk-main-wrapper " id="main-content" role="main">
                <div class="govuk-grid-row">
                    <div class="govuk-grid-column-two-thirds">
                        @include('govuk::parts.caption')
                        @include('govuk::parts.title')
                        @yield('before-main')
                        @yield('main')
                        @yield('after-main')
                    </div>

                    <aside class="govuk-grid-column-one-third">
                        @yield('aside')
                    </aside>
                </div>
            </main>
        </div>

        @include('govuk::layout.footer')
        @include('govuk::layout.foot')
    </body>
</html>
