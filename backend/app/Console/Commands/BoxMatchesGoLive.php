<?php

namespace App\Console\Commands;
use App\Model\BoxMatches;
use Illuminate\Console\Command;

class BoxMatchesGoLive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'boxmatch:live';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        BoxMatches::goLive();
    }
}
