<?php

// TODO Turn into library, run via php husky

/**
 * Generate badges as part of your pre-push hooks!
 * 
 * 1. Ensure that PHPUnit outputs coverage with the following settings:
 *     <coverage>
 *         <report>
 *             <text outputFile=".phpunit.cache/coverage.txt" showUncoveredFiles="false" showOnlySummary="true"/>
 *         </report>
 *     </coverage>
 * 
 * 2. Ensure that PHPUnit outputs the test log with the following settings:
 *     <logging>
 *         <junit outputFile=".phpunit.cache/tests.xml" />
 *     </logging>
 * 
 * 3. Add `badges.php` to the `.husky` directory
 * 
 * 4. Add the following commands to the pre-push hook:
 *     php badges.php
 *     git add .github/*.svg
 *     git commit -m "Updated badges" --no-verify
 */

makeComposerBadge();
makeCoverageBadge();
makeLaravelBadge();
makeNpmBadge();
makePhpBadge();
makeTestsBadge();

/*
 * Make a badge which shows how many Composer dependencies are out of date
 */
function makeComposerBadge(): void
{
    $output = [];
    
    exec('composer outdated --direct 2>&1', $output);
    $count = count($output) - 3;
    
    if ($count === -2) {
        $value = 'Up to date';
        $status = 1;
    } elseif ($count <= 3) {
        $value = "$count outdated";
        $status = 0;
    } else {
        $value = "$count outdated";
        $status = -1;
    }
    
    makeBadge('Composer', $value, $status, 'composer');
}

/*
 * Make a badge which shows the coverage results
 */
function makeCoverageBadge(): void
{
    $file = fopen(__DIR__.'/../.phpunit.cache/coverage.txt', 'r');
    fgets($file);
    fgets($file);
    fgets($file);
    $line = fgets($file);
    fclose($file);

    $result = (int) trim(
        substr($line, strpos($line, 'Classes: ') + 9, 3),
        '.',
    );
    
    if ($result >= 80) {
        $status = 1;
    } elseif ($result >= 60) {
        $status = 0;
    } else {
        $status = -1;
    }
    
    makeBadge('Coverage', "$result%", $status, 'coverage');
}

/*
 * Make a badge which shows the frontend being used
 */
function makeFrontendBadge(): void
{
    $requirements = json_decode(
        file_get_contents(__DIR__ . '/../composer.json'),
        true,
    )['require'] ?? [];
    
    if (isset($requirements['anthonyedmonmds/govuk-laravel']) === true) {
        $frontend = 'GOV.UK';
        $status = 1;
    } elseif (isset($requirements['livewire/livewire']) === true) {
        $frontend = 'Livewire';
        $status = 0;
    } else {
        $frontend = 'Vue';
        $status = -1;
    }
    
    makeBadge('Frontend', $frontend, $status, 'frontend');
}

/*
 * Make a badge which shows the Laravel version required by Composer
 */
function makeLaravelBadge(): void
{
    $laravel = json_decode(
        file_get_contents(__DIR__ . '/../composer.json'),
        true,
    )['require']['laravel/framework'] ?? 'Unknown';

    $laravel = trim($laravel, '^');
    
    $status = match ($laravel) {
        '10' => 1,
        '9' => 0,
        default => -1,
    };

    makeBadge('Laravel', $laravel, $status, 'laravel');
}

/*
 * Make a badge which shows how many NPM dependencies are out of date
 */
function makeNpmBadge(): void
{
    $output = [];

    exec('npm outdated 2>&1', $output);
    $count = count($output) - 1;
    
    if ($count === -1) {
        $value = 'Up to date';
        $status = 1;
    } elseif ($count <= 3) {
        $value = "$count outdated";
        $status = 0;
    } else {
        $value = "$count outdated";
        $status = -1;
    }

    makeBadge('NPM', $value, $status, 'npm');
}

/*
 * Make a badge which shows the PHP version required by Composer
 */
function makePhpBadge(): void
{
    $php = json_decode(
        file_get_contents(__DIR__ . '/../composer.json'),
        true,
    )['require']['php'] ?? 'Unknown';
    
    $php = trim($php, '^');
    
    $status = match ($php) {
        '8.2' => 1,
        '8.1', '8.0' => 0,
        default => -1,
    };

    makeBadge('PHP', $php, $status, 'php');
}

/*
 * Make a badge which shows the tests result
 */
function makeTestsBadge(): void
{
    $file = fopen(__DIR__.'/../.phpunit.cache/tests.xml', 'r');
    fgets($file);
    fgets($file);
    $line = fgets($file);
    fclose($file);
    
    $errors = (int) substr($line, strpos($line, 'errors="') + 8, 1);
    $failures = (int) substr($line, strpos($line, 'failures="') + 10, 1);
    
    if ($errors === 0 && $failures === 0) {
        $label = 'Pass';
        $status = 1;
    } else {
        $label = 'Fail';
         $status = -1;
    }
    
    makeBadge('Tests', $label, $status, 'tests');
}

/*
 * Generate and output an SVG badge, where the label is on the left, the value is on the right,
 * and the colour is determined by the status: 1 = success, 0 = warning, -1 = failure.
 */
function makeBadge(
    string $label,
    string $value,
    int $status,
    string $filename,
): void {
    $characterWidth = 8;
    
    $label = strtoupper($label);
    $value = strtoupper($value);
    
    $labelWidth = (strlen($label) * $characterWidth) + 4;
    $valueWidth = (strlen($value) * $characterWidth) + 4;
    $fullWidth = $labelWidth + $valueWidth;
    
    $colour = match ($status) {
        1 => '00703c',
        0 => 'f47738',
        default => 'd4351c',
    };

    $svg = '<svg
        xmlns="http://www.w3.org/2000/svg"
        width="'.$fullWidth.'"
        height="20"
        role="img"
        aria-label="'.$label.': '.$value.'"
    >
        <title>'.$label.': '.$value.'</title>
        
        <linearGradient id="s" x2="0" y2="100%">
            <stop offset="0" stop-color="#bbb" stop-opacity=".1"/>
            <stop offset="1" stop-opacity=".1"/>
        </linearGradient>
        
        <clipPath id="r">
            <rect width="'.$fullWidth.'" height="20" rx="3" fill="#fff"/>
        </clipPath>
        
        <g clip-path="url(#r)">
            <rect width="'.$labelWidth.'" height="20" fill="#555"/>
            <rect x="'.$labelWidth.'" width="'.$valueWidth.'" height="20" fill="#'.$colour.'"/>
            <rect width="'.$fullWidth.'" height="20" fill="url(#s)"/>
        </g>
        
        <g fill="#ffffff" font-family="Consolas, monospace" font-size="12">
            <text aria-hidden="true" x="'.($labelWidth / 2).'" y="15" fill="#010101" fill-opacity=".3" text-anchor="middle">'.$label.'</text>
            <text x="'.($labelWidth / 2).'" y="14" fill="#ffffff" text-anchor="middle">'.$label.'</text>
            
            <text aria-hidden="true" x="'.($labelWidth + ($valueWidth / 2)).'" y="15" fill="#010101" fill-opacity=".3" text-anchor="middle">'.$value.'</text>
            <text x="'.($labelWidth + ($valueWidth / 2)).'" y="14" fill="#ffffff" text-anchor="middle">'.$value.'</text>
        </g>
    </svg>';

    file_put_contents(__DIR__."/../.github/$filename.svg", $svg);
}
