<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
      * The table associated with the model.
      *
	  * author <gubera>
	  *
      * @var string
      */
      protected $table = 'tasks';

     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     protected $fillable = [
        'title', 'description', 'interval','granularity','status','user_id'
     ];
	
	 public function user()
     {
        return $this->belongsTo('App\User');
     }

}