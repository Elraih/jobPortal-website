<?php

namespace App\Console\Commands;

use App\Models\JobPost;
use Carbon\Carbon;
use Illuminate\Console\Command;

class JobPostDeadline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:job-post-deadline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark job posts as closed if the deadline has passed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        $expiredJobs = JobPost::where('status', 'open') // or 'open', based on your system
            ->whereDate('application_deadline', '<', $now->toDateString())
            ->update(['status' => 'closed']);

        $this->info("Expired jobs updated successfully.");
    }
}
