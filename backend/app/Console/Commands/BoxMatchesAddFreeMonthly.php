<?php

namespace App\Console\Commands;
use App\Model\User;
use Illuminate\Console\Command;

class BoxMatchesAddFreeMonthly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'boxmatch:add-free-monthly';

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
        User::addFreeBoxfightsMonthly();
    }
}
