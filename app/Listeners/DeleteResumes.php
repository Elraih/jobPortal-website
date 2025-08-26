<?php

namespace App\Listeners;

use App\Events\JobPostDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DeleteResumes implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(JobPostDeleted $event): void
    {
    
    // $applications = $event->jobPost->jobApplications;
    
    $filePaths = $event->filePaths;
        
    if(!empty($filePaths)) {
            foreach ($filePaths as $filePath) {
                if ($filePath && Storage::disk('public')->exists($filePath)) {
                    
                    Storage::disk('public')->delete($filePath);
                }
            }
        }

    }
}
