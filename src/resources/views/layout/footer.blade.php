<footer class="govuk-footer" role="contentinfo">
    <div class="govuk-width-container ">
        <div class="govuk-footer__meta">
            <div class="govuk-footer__meta-item govuk-footer__meta-item--grow">
                <x-govuk::h2 size="s">Help & Support</x-govuk::h2>

                <ul class="govuk-footer__list govuk-!-margin-bottom-3">
                    <li class="govuk-footer__list-item">
                        <a
                            class="govuk-footer__link"
                            href="{{ route('privacy') }}"
                        >
                            Privacy & Cookies
                        </a>
                    </li>

                    <li class="govuk-footer__list-item">
                        <a
                            class="govuk-footer__link"
                            href="{{ route('support') }}"
                            target="_blank"
                        >
                            Contact Support (opens in a new tab)
                        </a>
                    </li>

                    <li class="govuk-footer__list-item">
                        <a
                            class="govuk-footer__link"
                            href="{{ route('govuk-ds') }}"
                            target="_blank"
                        >
                            Built on the GOV.UK Design System (opens in a new tab)
                        </a>
                    </li>
                </ul>
            </div>

            <div class="govuk-footer__meta-item">
                <p class="govuk-footer__licence-description govuk-!-text-align-right govuk-!-margin-0">
                    <img
                        src="{{ asset('images/logo.svg') }}"
                        alt="Network Rail"
                        height="55"
                    />
                    <br/><br/>
                    <img
                        src="{{ asset('images/rs_logo_75.png') }}"
                        alt="Route Services"
                    />
                </p>
            </div>
        </div>
    </div>
</footer>


