<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

use AnthonyEdmonds\GovukLaravel\Exceptions\FormStepNotFound;
use Illuminate\Support\Facades\Route;

abstract class Form
{
    public const KEY = 'form';

    public const TITLE = 'Form Title';

    public const HAS_START_PAGE = true;
    public const START_BUTTON_LABEL = 'Start';
    public const START_BLADE = 'form.start';

    public const HAS_SUMMARY_PAGE = true;
    public const HAS_CONFIRMATION_PAGE = true;

    public const SECTIONS = [];

    protected string $routeBase;

    // Construction
    public function __construct()
    {
        $this->setRouteBase();
    }

    // Accessors
    public function getRouteBase(): string
    {
        return $this->routeBase;
    }

    // Actions
    //abstract public function authorize(): bool;

    //abstract public function submit(): void;

    public function getStepByKey(string $key): FormStep
    {
        $stepClass = $this->getStepClassByKey($key);
        return new $stepClass($this);
    }

    // Routes
    public function firstStepRoute(): string
    {
        return $this->getRouteForStep(0, 0);
    }

    public function nextStepRoute(): string
    {
        // isAtEndOfSection

        return $this->getRouteForStep();
    }

    public function previousStepRoute(): string
    {
        // isAtStartOfSection

        return $this->getRouteForStep();
    }

    // Utilities
    protected function setRouteBase(): void
    {
        $route = Route::currentRouteName();

        $this->routeBase = substr(
            $route,
            0,
            strrpos($route, '.')
        );
    }

    protected function getRouteForStep(int $section, int $step): string
    {
        return route("$this->routeBase.create", [
            $this->getStepClassByIndex(0, 0)::KEY
        ]);
    }

    protected function getStepClassByIndex(int $section, int $step): string
    {
        if (isset(static::SECTIONS[$section]) === true) {
            $section = static::SECTIONS[$section];
            return $section::getStepClassByIndex($step);
        }

        throw new FormStepNotFound("$section-$step");
    }

    protected function getStepClassByKey(string $key): string
    {
        foreach (static::SECTIONS as $section) {
            if ($section::hasStepClassByKey($key) === true) {
                return $section::getStepClassByKey($key);
            }
        }

        throw new FormStepNotFound($key);
    }
}
