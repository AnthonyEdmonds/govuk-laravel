<!DOCTYPE html>
<html lang="en" class="govuk-template ">
    @include('layout.head')

    <body class="govuk-template__body">
        <script>
            document.body.className = ((document.body.className) ? document.body.className + ' js-enabled' : 'js-enabled');
        </script>

        <a href="#main-content" class="govuk-skip-link">Skip to main content</a>

        @include('layout.header')

        <div class="govuk-width-container ">
            @include('parts.testing')
            @include('parts.impersonation')
            @yield('heading')
            @include('parts.breadcrumbs')
            @include('parts.back')
            @include('flash::message')
            @include('parts.errors')

            <main class="govuk-main-wrapper " id="main-content" role="main">
                <div class="govuk-grid-row">
                    <div class="govuk-grid-column-two-thirds">
                        @include('parts.caption')
                        @include('parts.title')
                        @yield('content')
                    </div>

                    <aside class="govuk-grid-column-one-third">
                        @yield('aside')
                    </aside>
                </div>
            </main>
        </div>

        @include('layout.footer')
        @include('layout.foot')
    </body>
</html>
