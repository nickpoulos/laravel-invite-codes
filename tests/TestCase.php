<?php

namespace Junges\Watchdog\Tests;

use Junges\Watchdog\Http\Models\Invite;
use Junges\Watchdog\WatchdogEventServiceProvider;
use Junges\Watchdog\WatchdogServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);

        (new WatchdogServiceProvider($this->app))->boot();
    }

    public function getPackageProviders($app)
    {
        return [
            WatchdogServiceProvider::class,
            WatchdogEventServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        $app['config']->set('views.path', [__DIR__.'/resources/views']);
    }

    private function setUpDatabase($app)
    {
        $app['config']->set('watchdog.tables.invites_table', 'test_invites_table');

        // Set up models for tests
        $app['config']->set('watchdog.models.invite_model', Invite::class);

        // Include migration files
        include_once __DIR__.'/../database/migrations/2020_01_29_162459_create_invites_table.php';

        (new \CreateInvitesTable())->up();
    }

}
