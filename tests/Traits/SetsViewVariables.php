<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ViewErrorBag;
use Illuminate\View\ComponentAttributeBag;

/**
 * Configure the global variables exposed when rendering a view
 *
 * @author Anthony Edmonds
 * @link https://github.com/AnthonyEdmonds
 */
trait SetsViewVariables
{
    /* If you know how to set the Request Session, let me know. */
    public function setRequestOld(array $old): void
    {
        $mock = $this->partialMock(Request::class, function ($mock) use ($old) {
            foreach ($old as $key => $value) {
                $mock
                    ->expects('old')
                    ->withSomeOfArgs($key)
                    ->andReturns($value);
            }
        });

        app()->bind('request', function () use ($mock) {
            return $mock;
        });
    }

    public function setViewAttributes(array $attributes = []): void
    {
        View::share('attributes', new ComponentAttributeBag($attributes));
    }

    public function setViewErrors(array $errors = []): void
    {
        $errorBag = new ViewErrorBag();

        foreach ($errors as $key => $error) {
            $errorBag->put($key, $error);
        }

        View::share('errors', $errorBag);
    }

    /* View rendering method taken from Illuminate\Foundation\Testing\Concerns\InteractsWithViews */
    public function setViewSlot(string $html = '', array $data = []): void
    {
        $tempDirectory = sys_get_temp_dir();

        /* @phpstan-ignore-next-line */
        if (in_array($tempDirectory, View::getFinder()->getPaths()) === false) {
            /* @phpstan-ignore-next-line */
            View::addLocation(sys_get_temp_dir());
        }

        $tempFileInfo = pathinfo(tempnam($tempDirectory, 'laravel-blade'));
        $tempFile = $tempFileInfo['dirname'].'/'.$tempFileInfo['filename'].'.blade.php';
        file_put_contents($tempFile, $html);

        View::share('slot', new HtmlString(
            view($tempFileInfo['filename'], $data)->render()
        ));
    }
}