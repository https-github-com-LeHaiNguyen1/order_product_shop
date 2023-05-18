<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRegisterRequest;
use App\Http\Requests\StoreLoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(StoreRegisterRequest $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $save_user = $user->save();
            if ($save_user) {
                return response()->json([
                    'message' => 'User created successfully!',
                    'code' => 201
                ], 201);
            }
        } catch (\Exception $ex) {
            //throw $th;
            return response()->json([
                'message' => $ex->getMessage(),
                'code' => 500
            ], 500);
        }
    }
    public function login(StoreLoginRequest $request)
    {
        try {
            $params = $request->all();
            $check     = [
                'email' => $params['email'],
                'password' => $params['password'],
            ];

            if (!Auth::attempt($check)) {
                return response()->json([
                    'message' => 'Unauthorized',
                    'code' => 401
                ], 401);
            }
            
            $user = $request->user();

            if ($user->role == 'administrator') {
                $tokenData = $user->createToken('Personal Access Tonken', ['do_anything']);
            } else {
                $tokenData = $user->createdToken('Personal Access Tonken', ['can_create']);
            }

            $token = $tokenData->token;

            if ($request->remember_me) {
                $token->expires_at = Carbon::now()->addWeeks(1);
            }

            if ($token->save()) {
                return response()->json([
                    'user' => $user,
                    'access_token' => $tokenData->accessToken,
                    'token_type' => 'Bearer',
                    'token_scope' => $tokenData->token->scopes[0],
                    'expires_at' => Carbon::parse($tokenData->token->expires_at)->toDateTimeString(),
                    'code' => 200,
                ], 200);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    public function logout(Request $request){
        
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Logout successfully!',
            'code' => 200
        ], 200);
    }
}