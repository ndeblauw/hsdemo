<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestScheduler extends Command
{
    protected $signature = 'app:test-scheduler';

    protected $description = 'Testing the scheduler with Ray';

    public function handle()
    {
        ray('Test scheduler called at: '.now()->format('H:i:s'));
    }
}
