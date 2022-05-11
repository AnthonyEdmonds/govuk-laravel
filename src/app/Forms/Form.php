<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

abstract class Form
{
    const KEY = 'form';
    const HAS_START_PAGE = false;
    const HAS_TASKS_PAGE = false;
    const HAS_SUMMARY_PAGE = false;
    const HAS_SUCCESS_PAGE = false;
    const SECTIONS = [];

    protected string $currentPageKey = 'start';

    // Construction
    public function __construct()
    {
        if (Session::has(self::KEY) === true) {
            $form = Session::get(self::KEY);

            $this->currentPageKey = $form['currentPageKey'];
        }
    }

    // Actions
    //abstract public function authorize(): bool;

    //abstract public function submit(): void;

    // Session
    public function clearFormProgress(): void
    {
        Session::forget(self::KEY);
    }

    public function saveFormProgress(): void
    {
        Session::put(self::KEY, [
            'currentPageKey' => $this->currentPageKey,
        ]);
    }
}
