<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notification;
use App\Models\Job;
use App\Models\Add;
use DB;

class DeleteNotificationsJobsAds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deletenotificationsjobsads:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Notifications Jobs Ads';

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
     * 0 1 * * * root /usr/bin/php /var/www/html/maheshwari-samaj/artisan deletenotificationsjobsads:cron > /dev/null 2>&1
     * @return mixed
     */
    public function handle()
    {
        set_time_limit(0);
        $notificationDueDate = date('Y-m-d', strtotime("-30 days"));
        $jobDueDate = date('Y-m-d', strtotime("-15 days"));
        $yesterday = date('Y-m-d', strtotime("-1 day"));
        DB::beginTransaction();
        try
        {
            // delete notifications
            $notifications = Notification::whereDate('updated_at', '=',$notificationDueDate)->get();
            if(is_object($notifications) && false == $notifications->isEmpty()){
                $this->info('Notification delete started.');
                foreach($notifications as $notification){
                    $notification->delete();
                }
                DB::commit();
            }
            // delete jobs
            $jobs = Job::whereDate('updated_at', '=',$jobDueDate)->get();
            if(is_object($jobs) && false == $jobs->isEmpty()){
                $this->info('Job delete started.');
                foreach($jobs as $job){
                    $job->delete();
                }
                DB::commit();
            }
            // delete ads
            $adds = Add::whereDate('end_date', '=',$yesterday)->get();
            if(is_object($adds) && false == $adds->isEmpty()){
                $this->info('Ad delete started.');
                foreach($adds as $add){
                    $add->delete();
                }
                DB::commit();
            }
        }
        catch(\Exception $e)
        {
            $this->info('DB rollback.');
            DB::rollback();
        }
    }
}