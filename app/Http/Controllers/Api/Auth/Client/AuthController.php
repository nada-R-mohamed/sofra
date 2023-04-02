<?php

namespace App\Http\Controllers\Api\Auth\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Auth\LoginRequest;
use App\Http\Requests\Api\Client\Auth\RegisterRequest;
use App\Mail\ResetPassword;
use App\Models\Client;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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

    public function resetPassword(Request $request) :JsonResponse
    {
        // validate email
        $validator = Validator::make($request->all(),[
            'email' =>'required|email|exists:clients,email',
        ]);
        if ($validator->fails()) {
            return $this->responseError([$validator->errors()]);
        }
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

    public function newPassword(Request $request) : JsonResponse
    {
        // validate [email - pin_code - password confirmed]
        $validator = Validator::make($request->all(),[
            'email' =>'required|email|exists:clients,email',
            'pin_code' =>'required|string|exists:clients,pin_code',
            'password' =>'required|string|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            return $this->responseError([$validator->errors()]);
        }

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
