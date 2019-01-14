<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Task;

class UserController extends Controller 
{
	public $successStatus = 200;
	/** 
     * login api 
     * @author <gowtham>
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
	/** 
     * Register api 
     * @author <gowtham>
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
		if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
		$input = $request->all(); 
				$input['password'] = bcrypt($input['password']); 
				$user = User::create($input); 
				$success['token'] =  $user->createToken('MyApp')-> accessToken; 
				$success['name'] =  $user->name;
		return response()->json(['success'=>$success], $this-> successStatus); 
    }
	/** 
     * details api 
     * @author <gowtham>
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
		$pendingtask = User::find($user->id)->task()->where('status','pending')->orderBy('id','desc')->get();
		$completedtask = User::find($user->id)->task()->where('status','completed')->orderBy('id','desc')->get();
        return response()->json(['pendingtask' => $pendingtask,'completedtask' => $completedtask,'user' => $user], $this-> successStatus); 
    } 
	
	/** 
     * Check User 
     * @author <gowtham>
     * @return \Illuminate\Http\Response 
     */ 
    public function checkUser() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 
}
