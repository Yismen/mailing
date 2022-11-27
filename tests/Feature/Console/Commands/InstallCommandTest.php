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
            ->assertSuccessful();
    }
}
