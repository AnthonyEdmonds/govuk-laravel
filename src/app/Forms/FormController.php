<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FormController extends Controller
{
    use AuthorizesRequests;

    public function start(string $form): View
    {
        //$this->authorize();

        return GovukPage::start(
            $form::TITLE,
            $form::HAS_TASKS_PAGE === true
                ? route('govuk-form.tasks', [$form::KEY])
                : $form::firstStep(),
            $form::START_BUTTON_LABEL,
            $form::START_BLADE
        );
    }

    public function tasks(string $form): View
    {
        //$this->authorize();

        return GovukPage::tasklist();
    }

    public function summary(string $form): View
    {
        //$this->authorize();

        return GovukPage::summary();
    }

    public function submit(string $form): RedirectResponse
    {
        //$this->authorize();

        $form = new $form();
        $form->submit();

        return redirect()->route('govuk-form.confirmation', [
            $form::KEY
        ]);
    }

    public function confirmation(string $form): View
    {
        //$this->authorize();

        return GovukPage::confirmation();
    }

    public function create(string $form, string $step): View
    {
        //$this->authorize();

        request()->route('form');
    }

    public function store(Request $request, string $form, string $step): RedirectResponse
    {
        //$this->authorize();

        return $form->next();
    }

    public function edit(string $form, string $step): View
    {
        //$this->authorize();
    }

    public function update(Request $request, string $form, string $step): RedirectResponse
    {
        //$this->authorize();

        return $form->next();
    }
}
