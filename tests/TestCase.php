<?php

namespace Dainsys\Mailing\Tests;

use Dainsys\Mailing\Mailing;
use Illuminate\Support\Facades\Auth;
use Dainsys\Mailing\Tests\Models\User;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Auth::routes();

        $this->withoutMix();
    }

    /**
     * Load the command service provider.
     *
     * @param  \Illuminate\Foundationlication $app
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            \Laravel\Ui\UiServiceProvider::class,
            \Livewire\LivewireServiceProvider::class,
            \Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider::class,
            \Flasher\Laravel\FlasherServiceProvider::class,
            \Dainsys\Mailing\MailingServiceProvider::class,
        ];
    }

    /**
 * Define database migrations.
 *
 * @return void
 */
    protected function defineDatabaseMigrations()
    {
        $this->loadLaravelMigrations();
    }

    protected function withAuthenticatedUser()
    {
        $user = User::factory()->create();

        $this->actingAs($user);
    }

    protected function withAuthorizedUser()
    {
        Mailing::registerSuperUsers(['yismen.jorge@gmail.com']);

        $user = User::factory()->create([
            'email' => 'yismen.jorge@gmail.com',
            'name' => 'Yismen Jorge'
        ]);

        $this->actingAs($user);
    }

    public function withoutAuthorizedUser()
    {
        $user = User::factory()->create([
            'email' => 'some@random.com',
            'name' => 'Some Random'
        ]);

        $this->actingAs($user);
    }
}
