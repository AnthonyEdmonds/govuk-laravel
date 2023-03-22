<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Traits;

use Illuminate\Routing\Route;
use ReflectionClass;

/**
 * Fool the system into thinking that you are totally on a Route right now
 *
 * @author Anthony Edmonds
 *
 * @link https://github.com/AnthonyEdmonds
 */
trait FakesRoute
{
    public function fakeRoute(
        string $name,
        string $uri,
        string $method = 'get',
        array $parameters = [],
    ): Route {
        $fakeRoute = new Route($method, $uri, []);
        $fakeRoute->name($name);
        $fakeRoute->parameters = $parameters;

        $router = app('router');
        $reflection = new ReflectionClass($router);
        $property = $reflection->getProperty('current');
        $property->setAccessible(true);
        $property->setValue($router, $fakeRoute);

        return $fakeRoute;
    }
}
