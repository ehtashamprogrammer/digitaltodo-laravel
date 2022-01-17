<?php

namespace App\Console;

use App\Events\TaskExpired;
use App\Models\Task;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
          $expired_tasks =  Task::where('due_date','>', \Carbon\Carbon::now())
              ->where('notified', false)
                ->orderBy('created_at', 'asc')->get();
          $expired_tasks_id = $expired_tasks->pluck('id');
            if (count($expired_tasks) > 0) {
                foreach ($expired_tasks as $task){
                    broadcast(new TaskExpired($task,$task->user_id));
                }
                Task::whereIn('id',$expired_tasks_id)->update([
                    'notified' => true
                ]);
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
