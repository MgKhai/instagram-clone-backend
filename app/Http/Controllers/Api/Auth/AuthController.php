<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Api\Auth\AuthResource;

class AuthController extends Controller
{
    use ApiResponse;

    /**
     * user login
     */
    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(),422);
        }

        // retrieve validated input
        $validatedData = $validator->validated();

        $user = User::where('email',$request->email)->first();

        if(!$user || $user['role'] != 'user'){
            return $this->errorResponse('Your credentials have not served!', 404);
        }

        if(!Hash::check($validatedData['password'], $user->password)){
            return $this->errorResponse('Your credential is wrong!', 401);
        }

        $accessToken = $user->createToken('access-token', ['*'], now()->addHour())->plainTextToken;

        $content = [
            'user' => $user,
            'accessToken' => $accessToken,
        ];

        return $this->successResponse('Login success', new AuthResource($content), 200);

    }

    /**
     * user register
     */
    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(),422);
        }

        $registerData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ];

        $user = User::create($registerData);
        $accessToken = $user->createToken('access-token', ['*'], now()->addHour())->plainTextToken;

        $content = [
            'user' => $user,
            'accessToken' => $accessToken
        ];

        return $this->successResponse('Register success', new AuthResource($content), 200);

    }


}
