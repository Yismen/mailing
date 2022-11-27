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
        // Init terminations type
        // Init termination reasons
        // Init suspention types

        return 0;
    }
}
