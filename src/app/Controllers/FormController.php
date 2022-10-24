<?php

namespace AnthonyEdmonds\GovukLaravel\Controllers;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;

class FormController extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function start(string $formKey): View
    {
        $form = Form::getForm($formKey);
        $form->checkAccess();

        return $form->start();
    }

    public function create(string $formKey): RedirectResponse
    {
        $form = Form::getForm($formKey);
        $form->checkAccess();

        return $form->create();
    }

    public function question(string $formKey, string $mode, string $questionKey, int|string|null $subjectKey = null): View
    {
        $form = Form::getForm($formKey);
        $form->checkAccess();

        return $form->question($mode, $questionKey, $subjectKey);
    }

    public function store(Request $request, string $formKey, string $mode, string $questionKey): RedirectResponse
    {
        $form = Form::getForm($formKey);
        $form->checkAccess();

        return $form->store($request, $mode, $questionKey);
    }

    public function update(Request $request, string $formKey, string $mode, string $questionKey, int|string $subjectKey): RedirectResponse
    {
        $form = Form::getForm($formKey);
        $form->checkAccess();

        return $form->update($request, $mode, $questionKey, $subjectKey);
    }

    public function summary(string $formKey, string $mode, int|string $subjectKey = null): View
    {
        $form = Form::getForm($formKey);
        $form->checkAccess();

        return $form->summary($mode, $subjectKey);
    }

    public function submit(string $formKey, string $mode, int|string $subjectKey = null): RedirectResponse
    {
        $form = Form::getForm($formKey);
        $form->checkAccess();

        return $form->submitForm($mode, $subjectKey);
    }

    public function confirmation(string $formKey, string $mode, int|string $subjectKey = null): View
    {
        $form = Form::getForm($formKey);
        $form->checkAccess();

        return $form->confirmation($subjectKey);
    }
}
