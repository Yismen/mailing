<?php

namespace Dainsys\Mailing\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailing:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Dainsys Mailing';

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
        $this->call('vendor:publish', ['--tag' => 'mailing:assets', '--force' => true]);

        if ($this->confirm('Would you like to run the mailing\'s migrations now?')) {
            $this->call('migrate');
        }

        if ($this->confirm('Would you like to publish the mailing\'s configuration file?')) {
            $this->call('vendor:publish', ['--tag' => 'mailing:config', '--force' => true]);
        }

        if ($this->confirm('Would you like to publish the mailing\'s translation file?')) {
            $this->call('vendor:publish', ['--tag' => 'mailing:translations']);
        }

        if ($this->confirm('Would you like to publish the mailing\'s view files?')) {
            $this->call('vendor:publish', ['--tag' => 'mailing:views']);
        }

        $this->info('All done!');

        return 0;
    }
}
