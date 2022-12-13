<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class WriteLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'write:logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Write log when run this command';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('Said run schedule at: ' . Carbon::now());
        return Command::SUCCESS;
    }
}
