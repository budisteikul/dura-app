<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Symfony\Component\Process\Process;
use DB;

class RCloneImages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        DB::table('jobs')->where('payload','LIKE','%RCloneImages%')->delete();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $process = new Process(array('rclone','--config=/home/pi/.rclone.conf', 'sync', '/home/pi/public_html/ratnawahyu.com/public/storage/eca1ca75-9e80-493f-bfef-cbeb44f8aac3/images/original/', 'gdrive:/ratnawahyu.com/'));
		$process->run();
    }
}
