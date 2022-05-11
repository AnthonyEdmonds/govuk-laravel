<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

use AnthonyEdmonds\GovukLaravel\Exceptions\FormStepNotFound;

abstract class FormSection
{
    public const KEY = 'form-section';
    public const STEPS = [];

    // Steps
    public static function getStepClassByIndex(int $index): string
    {
        if (isset(static::STEPS[$index]) === true) {
            return static::STEPS[$index];
        }

        throw new FormStepNotFound($index);
    }

    public static function hasStepClassByIndex(int $index): bool
    {
        return isset(static::STEPS[$index]) === true;
    }

    public static function getStepClassByKey(string $key): string
    {
        foreach (static::STEPS as $step) {
            if ($step::KEY === $key) {
                return $step;
            }
        }

        throw new FormStepNotFound($key);
    }

    public static function hasStepClassByKey(string $key): bool
    {
        foreach (static::STEPS as $step) {
            if ($step::KEY === $key) {
                return true;
            }
        }

        return false;
    }
}
