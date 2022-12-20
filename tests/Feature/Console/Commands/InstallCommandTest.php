<?php

namespace Dainsys\Mailing\Tests\Feature\Console\Commands;

use Dainsys\Mailing\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\Mailing\Console\Commands\InstallCommand;

class InstallCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function install_command_creates_site()
    {
        $this->artisan(InstallCommand::class)
            ->expectsConfirmation('Would you like to run the mailing\'s migrations now?', 'no')
            ->expectsConfirmation('Would you like to publish the mailing\'s configuration file?', 'no')
            ->expectsConfirmation('Would you like to publish the mailing\'s translation file?', 'no')
            ->expectsConfirmation('Would you like to publish the mailing\'s view files?', 'no')
            ->assertSuccessful();
    }
}
