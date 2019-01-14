<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\WelcomeMail;
use Mail;
use App\Jobs\SendWelcomeMail;
use Carbon\Carbon;
use DB;
use Illuminate\Contracts\Bus\Dispatcher;

class SendWelcomeMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

		
	protected $email;
	protected $title;
	protected $description;
	protected $granularity;
	protected $interval;
	protected $task_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$title,$description,$granularity,$interval,$task_id)
    {
         $this->email = $email;
		 $this->title = $title;
		 $this->description = $description;
		 $this->granularity = $granularity;
		 $this->interval=$interval;
		 $this->task_id=$task_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new WelcomeMail($this->title,$this->description));
		
		if($this->granularity == "minutes")
		{
			 $emailJob = (new SendWelcomeMail($this->email,$this->title,$this->description,$this->granularity,$this->interval,$this->task_id))->delay(Carbon::now()->addMinutes($this->interval));
        	 $id  = app(Dispatcher::class)->dispatch($emailJob);
		}
		else if($this->granularity == "hours")
		{
			 $emailJob = (new SendWelcomeMail($this->email,$this->title,$this->description,$this->granularity,$this->interval,$this->task_id))->delay(Carbon::now()->addHour($this->interval));
        	 $id  = app(Dispatcher::class)->dispatch($emailJob);
		}
		else if($this->granularity == "days")
		{
			 $emailJob = (new SendWelcomeMail($this->email,$this->title,$this->description,$this->granularity,$this->interval,$this->task_id))->delay(Carbon::now()->addDays($this->interval));
        	 $id  = app(Dispatcher::class)->dispatch($emailJob);
		}
       
		DB::table('jobs')
            ->where('id', $id)
            ->update(['task_id' => $this->task_id]);
    }
}
