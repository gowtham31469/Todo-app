<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Jobs\SendWelcomeMail;
use App\Http\Controllers\Controller; 
use Carbon\Carbon;
use Illuminate\Contracts\Bus\Dispatcher;
use App\Task;
use Illuminate\Support\Facades\Auth; 
use DB;

class TaskController extends Controller
{
	public $successStatus = 200;
	
	/**
	 * Method to set a task
	 * @author <gowtham>
	 * @param  Request $request [title,description,interval,granularity]
	 * @return Json Json object containing result status
	 */
	
    public function setTask(Request $request)
    {
		$user = Auth::user();
		$email=$user->email;
		$title=$request['title'];
		$description=$request['description'];
		$interval=$request['interval'];
		$granularity=$request['granularity'];
		
		$task_id = Task::create([
						'user_id'=>$user->id,
                        'title' => $title,
                        'description' => $description,
						'interval' => $interval,
						'granularity' => $granularity,
						'status'=>"pending"
        			])->id;
		if($granularity == "minutes")
		{
			 $emailJob = (new SendWelcomeMail($email,$title,$description,$granularity,$interval,$task_id))->delay(Carbon::now()->addMinutes($interval));
        	 $id  = app(Dispatcher::class)->dispatch($emailJob);
		}
		else if($granularity == "hours")
		{
			 $emailJob = (new SendWelcomeMail($email,$title,$description,$granularity,$interval,$task_id))->delay(Carbon::now()->addHour($interval));
        	 $id  = app(Dispatcher::class)->dispatch($emailJob);
		}
		else if($granularity == "days")
		{
			 $emailJob = (new SendWelcomeMail($email,$title,$description,$granularity,$interval,$task_id))->delay(Carbon::now()->addDays($interval));
        	 $id  = app(Dispatcher::class)->dispatch($emailJob);
		}
       
		
		DB::table('jobs')
            ->where('id', $id)
            ->update(['task_id' => $task_id]);

       return response()->json(['success' => 'true'], $this-> successStatus); 
    }
	
	
	/**
	 * Method to complete a task
	 * @author <gowtham>
	 * @param  Request $request [task_id]
	 * @return Json Json object containing result status
	 */
	
	function completeTask(Request $request)
	{
		
			$task_id = $request['task_id'];
		
			Task::where('id', $task_id)
            ->update(['status' => "completed"]);
		
			DB::table('jobs')
            ->where('task_id', $task_id)
            ->delete();
			return response()->json(['success' => 'true'], $this-> successStatus); 
	}
	
}
