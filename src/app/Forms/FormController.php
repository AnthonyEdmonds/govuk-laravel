<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

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
        $formClass::authorize('start');
        return $formClass::start();
    }

    public function step(string $stepKey, string $formClass): View
    {
        $formClass::authorize('create');

        return $formClass::step($stepKey);
    }

    public function save(Request $request, string $stepKey, string $formClass): RedirectResponse
    {
        $formClass::authorize('store');
        return $formClass::nextPage();
    }

    public function summary(string $formClass): View
    {
        $formClass::authorize('start');
        return $formClass::summary();
    }

    public function submit(string $formClass): RedirectResponse
    {
        $formClass::authorize('submit');
        return $formClass::submit();
    }

    public function confirmation(string $formClass): View
    {
        $formClass::authorize('confirmation');
        return $formClass::confirmation();
    }

    public function exit(string $formClass): RedirectResponse
    {
        $formClass::authorize('exit');
        return $formClass::exit();
    }
}
