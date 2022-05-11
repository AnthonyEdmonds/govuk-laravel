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

    public function start(string $formClass): View
    {
        //$this->authorize();

        $form = new $formClass();

        return GovukPage::start(
            $form::TITLE,
            $form->firstStepRoute(),
            $form::START_BUTTON_LABEL,
            $form::START_BLADE
        );
    }

    public function create(string $formClass, string $step): View
    {
        //$this->authorize();

        $form = new $formClass();

        return $form->getStepByKey($step);
    }

    public function store(Request $request, string $formClass, string $step): RedirectResponse
    {
        //$this->authorize();

        return $formClass->next();
    }

    public function edit(string $formClass, string $step): View
    {
        //$this->authorize();
    }

    public function update(Request $request, string $formClass, string $step): RedirectResponse
    {
        //$this->authorize();

        return $formClass->next();
    }

    public function summary(string $formClass): View
    {
        //$this->authorize();

        return GovukPage::summary();
    }

    public function submit(string $formClass): RedirectResponse
    {
        //$this->authorize();

        $form = new $formClass();
        $form->submit();

        return redirect()->route('govuk-form.confirmation', [
            $form::KEY
        ]);
    }

    public function confirmation(string $formClass): View
    {
        //$this->authorize();

        return GovukPage::confirmation();
    }
}
