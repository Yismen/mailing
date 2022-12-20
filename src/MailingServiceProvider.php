<?php

namespace Dainsys\Mailing;

use Livewire\Livewire;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Console\Scheduling\Schedule;
use Dainsys\Mailing\Console\Commands\InstallCommand;
use Dainsys\Mailing\Contracts\AuthorizedUsersContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;

class MailingServiceProvider extends AuthServiceProvider
{
    public function boot()
    {
        Model::preventLazyLoading(true);
        Paginator::useBootstrap();

        $this->registerPolicies();
        $this->registerEvents();
        $this->bootPublishableAssets();
        $this->bootLoads();
        $this->bootLivewireComponents();

        if ($this->app->runningInConsole() && !app()->isProduction()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }

        $this->registerSchedulledCommands();

        Gate::define('interact-with-mailing-admin', function (\Illuminate\Foundation\Auth\User $user) {
            return resolve(AuthorizedUsersContract::class)
            ->has($user->email);
        });
    }

    public function register()
    {
        $this->app->singleton(\Dainsys\Mailing\Contracts\AuthorizedUsersContract::class, function ($app) {
            return new \Dainsys\Mailing\Support\AuthorizedUsers();
        });

        $this->app->singleton(\Dainsys\Mailing\Contracts\InstanceFromNameContract::class, function ($app) {
            return new \Dainsys\Mailing\Services\Instances\FromModel('Dainsys\\Mailing\\Models');
        });

        $this->mergeConfigFrom(
            __DIR__ . '/../config/mailing.php',
            'mailing'
        );

        \Dainsys\Mailing\Mailing::bind(app_path('Mail'));
    }

    protected function bootPublishableAssets()
    {
        $this->publishes([
            __DIR__ . '/../config/mailing.php' => config_path('mailing.php')
        ], 'mailing:config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/dainsys/mailing')
        ], 'mailing:views');

        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/dainsys/mailing'),
        ], 'mailing:assets');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/mailing'),
        ], 'mailing:translations');
    }

    protected function bootLoads()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'mailing');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'mailing');
    }

    protected function registerSchedulledCommands()
    {
        $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {
        });
    }

    protected function registerEvents()
    {
    }

    protected function bootLivewireComponents()
    {
        Livewire::component('mailing::dashboard', \Dainsys\Mailing\Http\Livewire\Admin\Dashboard::class);

        Livewire::component('mailing::mailable.table', \Dainsys\Mailing\Http\Livewire\Mailable\Table::class);
        Livewire::component('mailing::mailable.index', \Dainsys\Mailing\Http\Livewire\Mailable\Index::class);
        Livewire::component('mailing::mailable.detail', \Dainsys\Mailing\Http\Livewire\Mailable\Detail::class);
        Livewire::component('mailing::mailable.form', \Dainsys\Mailing\Http\Livewire\Mailable\Form::class);

        Livewire::component('mailing::recipient.table', \Dainsys\Mailing\Http\Livewire\Recipient\Table::class);
        Livewire::component('mailing::recipient.index', \Dainsys\Mailing\Http\Livewire\Recipient\Index::class);
        Livewire::component('mailing::recipient.detail', \Dainsys\Mailing\Http\Livewire\Recipient\Detail::class);
        Livewire::component('mailing::recipient.form', \Dainsys\Mailing\Http\Livewire\Recipient\Form::class);
    }
}
