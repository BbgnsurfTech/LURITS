<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;
use App\User;
use App\Staff;
use App\Http\Resources\Admin\SmrResource;
use App\StudentAdmission;
use App\AssetCategory;
use App\Smr;
use Gate;
use App\Atlas;
use App\AtlasLink;

class AuthController extends Controller
{
	public function data()
	{
		$zones = Atlas::select('name_atlas_entity', 'code_atlas_entity')
                        ->where('code_ds_atlas_entity', 4)
                        ->groupBy('code_atlas_entity','name_atlas_entity')
                        ->get();
        return response(
            json_decode($zones),
        200);
	}

	public function data2(Request $request)
	{
		$stateLGA = AtlasLink::where('code_atlas_link', $request->id)->pluck('code_atlas_entity');
        $lga = Atlas::whereIn('code_atlas_entity', $stateLGA)->get();

        return response(
            json_decode($lga),
        200);
	}

	public function data3(Request $request)
	{	
		$schoolLGA = SchoolAtlas::where('code_atlas_entity', $request->id)->pluck('school_id');
        $finalschools = School::whereIn('id', $schoolLGA)->where('code_type_sector', $request->sector)->pluck('name','id');

        return response(
            json_decode($finalschools),
        200);
	}

	public function data4()
	{
		$data = Smr::all();
		return response(
			json_decode($data),
		200);
	}

	public function stud(Request $request)
	{
		return response(['message' => $request->name]);
	}

	public function login(Request $request)
	{
		$validator = Validator::make($request->all('email', 'password'),[
			'email' => 'required|string|email|max:255',
			'password' => 'required|string|max:255'
		]);

		if ($validator->fails()) {
			return response(['errors' => $validator->errors()], 422);
		}

		if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
			$user = $request->user();
			$tokenResult = $user->createToken("Personal Token");
			$tokenResult->expires_at = Carbon::now()->addWeeks(4);
			$token = $tokenResult->accessToken;

			return response([
				'success' => true,
				'user' => $user,
				'role' => $user->roles,
				'token' => $token,
			], 200);
		} else {
			$email = User::where('email', $request->email)->get();
			if ($email->isEmpty()) {
				return response([
					'success' => false,
					'error' => "The Email you entered is incorrect",
				], 422);	
			} else {
				return response([
					'success' => false,
					'error' => "The Password you entered is incorrect",
				], 422);
			}
		}
	}

	private function getResponse(User $user)
	{
		$user = $request->user();
		$tokenResult = $user->createToken("Personal Token");
		$token = $tokenResult->token;
		$token->expires_at = Carbon::now()->addWeeks(4);
		$token->save();

		return response([
			'token' => $token,
			'tokenType' => "Bearer",
			'expiresAt' => Carbon::parse($token->expires_at)->toDateTimeString()
		], 200);	
	}
}