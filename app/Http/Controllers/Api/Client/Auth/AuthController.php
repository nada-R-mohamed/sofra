<?php

namespace App\Http\Controllers\Api\Client\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Auth\LoginRequest;
use App\Http\Requests\Api\Client\Auth\NewPasswordRequest;
use App\Http\Requests\Api\Client\Auth\RegisterRequest;
use App\Http\Requests\Api\Client\Auth\ResetPasswordRequest;
use App\Mail\ResetPassword;
use App\Models\Client;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    use ApiResponses;

    public function register(RegisterRequest $request) : JsonResponse
    {

        try{

            $data = $request->except('password');
            $data['password'] = Hash::make($request->password);
            $client = Client::create($data);
            $client->token = "Bearer " . $client->createToken($request->device_name)->plainTextToken;
            return $this->responseData(compact('client'),'registered',201);

        }catch (\Exception $e){

            return $this->responseError([$e->getMessage()],statusCode: 422);
        }

    }
    public function login(LoginRequest $request) : JsonResponse
    {

        $client = Client::where('email',$request->email)->first();
        if(! $client || !  Hash::check($request->password,$client->password)){
            return $this->responseError([
                'email'=>'The provided credentials are incorrect.'
            ],statusCode:401);
        }
        $client->token = "Bearer " .$client->createToken($request->device_name)->plainTextToken;
        return $this->responseData(compact('client'));
    }
    public function logoutCurrentToken(Request $request) : JsonResponse
    {
        $request->user('sanctum')->currentAccessToken()->delete();
        return $this->responseSuccess('Your Current Acceess Token has been destroyed successfully');
    }

    public function logoutAllTokens(Request $request) : JsonResponse
    {
        $request->user('sanctum')->tokens()->delete();
        return $this->responseSuccess('All Of Your Acceess Token has been destroyed successfully');
    }

    public function resetPassword(ResetPasswordRequest $request) :JsonResponse
    {
        // get client by email
        $client = Client::where('email',$request->email)->first();
        if(! $client){
            return $this->responseError(['email' => 'The provided email is incorrect.'],statusCode:401);
        }
        // create pin_code
        $pin_code = rand(1000,9999);
        // update client with pin_code
        $client->pin_code = $pin_code;
        $client->save();
        // send it with email
        Mail::to($client->email)->send(new ResetPassword($pin_code));
        // return message
        return $this->responseSuccess("The Pin Code has ben send to your email");
    }

    public function newPassword(NewPasswordRequest $request) : JsonResponse
    {
        // get client by email
        $client = Client::where('email',$request->email)->first();
        if(! $client){
            return $this->responseError(['email' => 'The provided email is incorrect.'],statusCode:401);
        }
        // check pin_code
        if($client->pin_code != $request->pin_code){
            return $this->responseError(['pin_code' => 'The provided pin code is incorrect.'],statusCode:401);
        }
        // update new password
        $client->update([
            'password' => Hash::make($request->password),
            'pin_code' => null,
        ]);
        // return success
        return $this->responseSuccess('password updated successfully');
    }

}
