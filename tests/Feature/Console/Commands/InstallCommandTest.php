<?php

namespace Dainsys\Report\Tests\Feature\Console\Commands;

use Dainsys\Report\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\Report\Console\Commands\InstallCommand;

class InstallCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function install_command_creates_site()
    {
        $this->artisan(InstallCommand::class)
            ->expectsConfirmation('Would you like to run the report\'s migrations now?', 'no')
            ->expectsConfirmation('Would you like to publish the report\'s configuration file?', 'no')
            ->expectsConfirmation('Would you like to publish the report\'s translation file?', 'no')
            ->expectsConfirmation('Would you like to publish the report\'s view files?', 'no')
            ->assertSuccessful();
    }
}
