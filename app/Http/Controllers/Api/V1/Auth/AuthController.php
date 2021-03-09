<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;
use App\User;

class AuthController extends Controller
{
	public function stud(Request $request)
	{
		return response(['message' => $request->name, 'gender' => $request->price]);
	}

	public function login(Request $request)
	{
		// return response([
		// 	'success' => true,
		// 	'message' => "The Password you entered is incorrect",
		// ], 200);

		$validator = Validator::make($request->all('email', 'password'),[
			'email' => 'required|string|email|max:255',
			'password' => 'required|string|max:255'
		]);

		if ($validator->fails()) {
			return response(['errors' => $validator->errors()], 422);
		}

		if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
			$user = $request->user();
			$role = Auth::User()->roles()->with("permissions")->get();
			$tokenResult = $user->createToken("Personal Token");
			$tokenResult->expires_at = Carbon::now()->addWeeks(4);
			$token = $tokenResult->accessToken;

			if (Auth::User()->is_headTeacher) {
				$background = Auth::User()->school->background;
			} else {
				$background = null;
			}

			return response([
				'success' => true,
				'user' => $user,
				'atlas' => Auth::User()->atlas,
				'school' => $user->school,
				'role' => $role->first(),
				'permissions'=> $role->first()->permissions->pluck('title'),
				'token' => $token,
				'background' => $background,
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