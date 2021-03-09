<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Client;
use App\User;
use App\Http\Resources\Admin\UserResource;
use App\Http\Controllers\Api\V1\Auth\IssueTokenTrait;

class LoginController extends Controller
{

    use IssueTokenTrait;

	private $client;

	public function __construct(){
		$this->client = Client::find(2);
	}

    public function login(Request $request){

    	$this->validate($request, [
    		'email' => 'required',
    		'password' => 'required'
    	]);
        
        return $this->issueToken($request, 'password');
    }

    public function getLoginUserData(Request $request){

    $user = User::where('email', $request->email)->with(['roles'])->get();
        // if ($user != "") {
        //     if (Hash::check($request->password, $user->password)) {
        //         $role_id = $user->role_id;
        //     }
        // }
        //return $data;
        return new UserResource($user);
    }

    public function refresh(Request $request){
    	$this->validate($request, [
    		'refresh_token' => 'required'
    	]);

    	return $this->issueToken($request, 'refresh_token');

    }

    public function logout(Request $request){

    	$accessToken = Auth::user()->token();

    	DB::table('oauth_refresh_tokens')
    		->where('access_token_id', $accessToken->id)
    		->update(['revoked' => true]);

    	$accessToken->revoke();

    	return response()->json([], 204);

    }
}
