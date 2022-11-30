<?php

namespace Dainsys\Report;

use Livewire\Livewire;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Event;
use Illuminate\Database\Eloquent\Model;
use Dainsys\Report\Events\EmployeeSaved;
use Illuminate\Console\Scheduling\Schedule;
use Dainsys\Report\Listeners\UpdateFullName;
use Dainsys\Report\Console\Commands\InstallCommand;
use Dainsys\Report\Contracts\AuthorizedUsersContract;
use Dainsys\Report\Console\Commands\UpdateEmployeeSuspensions;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;

class ReportServiceProvider extends AuthServiceProvider
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
                // UpdateEmployeeSuspensions::class,
            ]);
        }

        $this->registerSchedulledCommands();

        Gate::define('interact-with-admin', function (\Illuminate\Foundation\Auth\User $user) {
            return resolve(AuthorizedUsersContract::class)
            ->has($user->email);
        });
    }

    public function register()
    {
        $this->app->singleton(\Dainsys\Report\Contracts\AuthorizedUsersContract::class, function ($app) {
            return new \Dainsys\Report\Support\AuthorizedUsers();
        });

        $this->app->singleton(\Dainsys\Report\Contracts\InstanceFromNameContract::class, function ($app) {
            return new \Dainsys\Report\Services\Instances\FromModel('Dainsys\\Report\\Models');
        });

        $this->mergeConfigFrom(
            __DIR__ . '/../config/report.php',
            'report'
        );

        \Dainsys\Report\Report::bind(app_path('Mail'));
    }

    protected function bootPublishableAssets()
    {
        $this->publishes([
            __DIR__ . '/../config/report.php' => config_path('report.php')
        ], 'report:config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/dainsys/report')
        ], 'report:views');

        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/dainsys/report'),
        ], 'report:assets');
    }

    protected function bootLoads()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'report');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    protected function registerSchedulledCommands()
    {
        $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {
            // $schedule->command(UpdateEmployeeSuspensions::class)->dailyAt('03:00');
        });
    }

    protected function registerEvents()
    {
        // Event::listen(EmployeeSaved::class, UpdateFullName::class);
    }

    protected function bootLivewireComponents()
    {
        Livewire::component('report::dashboard', \Dainsys\Report\Http\Livewire\Admin\Dashboard::class);

        Livewire::component('report::mailable.table', \Dainsys\Report\Http\Livewire\Mailable\Table::class);
        Livewire::component('report::mailable.index', \Dainsys\Report\Http\Livewire\Mailable\Index::class);
        Livewire::component('report::mailable.detail', \Dainsys\Report\Http\Livewire\Mailable\Detail::class);
        Livewire::component('report::mailable.form', \Dainsys\Report\Http\Livewire\Mailable\Form::class);

        Livewire::component('report::recipient.table', \Dainsys\Report\Http\Livewire\Recipient\Table::class);
        Livewire::component('report::recipient.index', \Dainsys\Report\Http\Livewire\Recipient\Index::class);
        Livewire::component('report::recipient.detail', \Dainsys\Report\Http\Livewire\Recipient\Detail::class);
        Livewire::component('report::recipient.form', \Dainsys\Report\Http\Livewire\Recipient\Form::class);
    }
}
