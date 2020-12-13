<?php

namespace Eightfold\DmsHelpers\Tests;

use Orchestra\Testbench\BrowserKit\TestCase;
use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use Eightfold\DmsHelpers\Tests\MockProvider\Controllers\RootController;
use Eightfold\DmsHelpers\Tests\MockProvider\Controllers\AssetsController;
use Eightfold\DmsHelpers\Tests\MockProvider\Controllers\MediaController;

/**
 * @group Route
 */
class RouteHelperTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return ['Eightfold\DmsHelpers\Tests\MockProvider\Provider'];
    }

    /**
     * @test
     * @group current
     *
     * @todo Update AbstractBridge to inherit from laravel base controller.
     *       The IoC container doesn't seem to allow for custom constructors.
     *       We receive a binding exception error when using those controllers in routes as invokable controllers. This could be avoided by using callbacks in the route; however, this has proven to make routes difficult to read. The only thing the route is looking for is a redirect, abort, or string (ultimately). Because this package is flagged as being dependent on Laravel it's not the end of the world; however, would be nice to decouple from Laravel at a later date.
     *
     */
    public function root_has_expected_content()
    {
        // $this->visit("/")->see("Hello, World!");

        // $this->visit("/assets/favicons/favicon.ico");

        $this->visit("/media/poster.png");
    }

    /**
     * @test
     */
    public function local_root_is_expected()
    {
        AssertEquals::applyWith(
            __DIR__ ."/content-folder",
            "string",
            8.93,
            321
        )->unfoldUsing(
            RootController::localRoot()
        );

        AssertEquals::applyWith(
            __DIR__ ."/content-folder/.assets",
            "string",
            4.43, // 3.88, // 3.53,
            390 // 334 // 330
        )->unfoldUsing(
            AssetsController::localRoot()
        );

        AssertEquals::applyWith(
            __DIR__ ."/content-folder/.media",
            "string",
            0.08, // 0.07, // 0.06,
            1
        )->unfoldUsing(
            MediaController::localRoot()
        );
    }

    /**
     * @test
     */
    public function images()
    {
        AssertEquals::applyWith(
            200,
            "integer",
            47.35, // ^ 17.9, // 17.19,
            3632 // 3628
        )->unfoldUsing(
            $this->call("GET", "/assets/favicons/favicon.ico")->getStatusCode()
        );

        AssertEquals::applyWith(
            200,
            "integer",
            2.41, // ^ 1,
            2
        )->unfoldUsing(
            $this->call("GET", "/media/poster.png")->getStatusCode()
        );
    }
}
