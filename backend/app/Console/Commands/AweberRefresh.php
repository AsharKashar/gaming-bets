<?php

namespace App\Console\Commands;

use App\Service\AweberService;
use Illuminate\Console\Command;

class AweberRefresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aweber:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command for test purposes';

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
     * @return mixed
     */
    public function handle()
    {
        $aweberService = new AweberService();
        $aweberService->refreshCredentials();
    }
}
