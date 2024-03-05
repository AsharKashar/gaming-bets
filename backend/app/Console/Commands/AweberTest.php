<?php

namespace App\Console\Commands;

use App\Service\AweberService;
use Illuminate\Console\Command;

class AweberTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aweber:test';

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
        $aweberService->subscribe('tester1@whmailtop.com', ['registered'], [
            'role' => 'user',
            'username' => 'tester1',
        ]);
    }
}
