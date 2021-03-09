<?php 

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\User;


trait IssueTokenTrait{

	public function issueToken(Request $request, $grantType, $scope = "*"){

		$params = [
    		'grant_type' => $grantType,
    		'client_id' => $this->client->id,
    		'client_secret' => $this->client->secret,    		
    		'scope' => $scope
    	];
        $user = User::where('email', $request->email)->first();

        if($grantType !== 'social'){
            $params['username'] = $request->username ?: $request->email;
        }

    	$request->request->add($params);

    	$proxy = Request::create('oauth/token', 'POST');

    	return Route::dispatch($proxy);

	}

}