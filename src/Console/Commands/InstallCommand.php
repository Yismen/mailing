<?php

namespace Dainsys\Report\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Dainsys Report';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('vendor:publish', ['--tag' => 'report:assets', '--force' => true]);

        if ($this->confirm('Would you like to run the report\'s migrations now?')) {
            $this->call('migrate');
        }

        if ($this->confirm('Would you like to publish the report\'s configuration file?')) {
            $this->call('vendor:publish', ['--tag' => 'report:config', '--force' => true]);
        }

        if ($this->confirm('Would you like to publish the report\'s translation file?')) {
            $this->call('vendor:publish', ['--tag' => 'report:translations']);
        }

        if ($this->confirm('Would you like to publish the report\'s view files?')) {
            $this->call('vendor:publish', ['--tag' => 'report:views']);
        }

        $this->info('All done!');

        return 0;
    }
}
