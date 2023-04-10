<?php

namespace App\Http\Controllers\Api\Restaurant\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Restaurant\Auth\LoginRequest;
use App\Http\Requests\Api\Restaurant\Auth\NewPasswordRequest;
use App\Http\Requests\Api\Restaurant\Auth\RegisterRequest;
use App\Http\Requests\Api\Restaurant\Auth\ResetPasswordRequest;
use App\Mail\ResetPassword;
use App\Models\Restaurant;
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
            $data = $request->except('password','image','category_id');
            $data['image'] = $this->uploadImage($request);
            $data['password'] = Hash::make($request->password);
            $restaurant = Restaurant::create($data);
            $restaurant->categories()->attach($request->category_id);
            $restaurant->token = "Bearer " . $restaurant->createToken($request->device_name)->plainTextToken;
            return $this->responseData(compact('restaurant'),'registered',201);

        }catch (\Exception $e){

            return $this->responseError([$e->getMessage()]);
        }

    }
    protected function uploadImage(Request $request)
    {
        $file = $request->file('image');
        $path = $file->store('/uploads',[
            'disk' => 'public'
        ]);
        return $path;
    }

    public function login(LoginRequest $request) : JsonResponse
    {

        $restaurant = Restaurant::where('email',$request->email)->first();
        if(! $restaurant || !  Hash::check($request->password,$restaurant->password)){
            return $this->responseError([
                'email'=>'The provided credentials are incorrect.'
            ],statusCode:401);
        }
        $restaurant->token = "Bearer " .$restaurant->createToken($request->device_name)->plainTextToken;
        return $this->responseData(compact('restaurant'));
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
        // get restaurant by email
        $restaurant = Restaurant::where('email',$request->email)->first();
        if(! $restaurant){
            return $this->responseError(['email' => 'The provided email is incorrect.'],statusCode:401);
        }
        // create pin_code
        $pin_code = rand(1000,9999);
        // update restaurant with pin_code
        $restaurant->pin_code = $pin_code;
        $restaurant->save();
        // send it with email
        Mail::to($restaurant->email)->send(new ResetPassword($pin_code));
        // return message
        return $this->responseSuccess("The Pin Code has ben send to your email");
    }

    public function newPassword(NewPasswordRequest $request) : JsonResponse
    {
        // get restaurant by email
        $restaurant = Restaurant::where('email',$request->email)->first();
        if(! $restaurant){
            return $this->responseError(['email' => 'The provided email is incorrect.'],statusCode:401);
        }
        // check pin_code
        if($restaurant->pin_code != $request->pin_code){
            return $this->responseError(['pin_code' => 'The provided pin code is incorrect.'],statusCode:401);
        }
        // update new password
        $restaurant->update([
            'password' => Hash::make($request->password),
            'pin_code' => null,
        ]);
        // return success
        return $this->responseSuccess('password updated successfully');
    }


}

