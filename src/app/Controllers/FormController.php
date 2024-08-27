<?php

namespace AnthonyEdmonds\GovukLaravel\Controllers;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class FormController extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function start(string $formKey): View|RedirectResponse
    {
        $form = Form::getForm($formKey);

        return $form->startBlade() !== false
            ? $form->start()
            : $this->create($formKey);
    }

    public function create(string $formKey): RedirectResponse
    {
        return Form::getForm($formKey)->create();
    }

    public function edit(string $formKey, string $subjectKey): RedirectResponse
    {
        $form = Form::getForm($formKey);
        $subject = $form->loadSubjectFromDatabase($subjectKey);

        Session::reflash();

        return $form->edit($subject);
    }

    public function question(string $formKey, string $mode, string $questionKey): View
    {
        return Form::getForm($formKey)->question($mode, $questionKey);
    }

    public function store(Request $request, string $formKey, string $mode, string $questionKey): RedirectResponse
    {
        return Form::getForm($formKey)->store($request, $mode, $questionKey);
    }

    public function skip(string $formKey, string $mode, string $questionKey): RedirectResponse
    {
        return Form::getForm($formKey)->skip($mode, $questionKey);
    }

    public function summary(string $formKey, string $mode): View
    {
        return Form::getForm($formKey)->summary($mode);
    }

    public function submit(string $formKey, string $mode): RedirectResponse
    {
        return Form::getForm($formKey)->submit($mode);
    }

    public function draft(string $formKey, string $mode): RedirectResponse
    {
        return Form::getForm($formKey)->draft($mode);
    }

    public function confirmation(string $formKey, string $mode, ?string $subjectKey = null): View|RedirectResponse
    {
        $form = Form::getForm($formKey);
        $subject = $form->loadConfirmationSubject($subjectKey);

        return $form->confirmationBlade() !== false
            ? $form->confirmation($mode, $subject)
            : redirect($form->exitRoute($subject));
    }
}
