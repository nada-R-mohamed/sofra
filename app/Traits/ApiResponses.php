<?php
namespace App\Traits;

trait ApiResponses {
    public function responseSuccess(string $message ,int $statusCode = 200)
    {
        return response()->json([
            "success"=>true,
            "message"=>$message,
            "data"=>(object)[],
            "errors"=>(object)[]
        ],$statusCode);
    }

    public function responseError(array $errors , string $message = "" ,int $statusCode = 422)
    {
        return response()->json([
            "success"=>false,
            "message"=>$message,
            "data"=>(object)[],
            "errors"=>(object)$errors
        ],$statusCode);
    }

    public function responseData(array $data , string $message = "" ,int $statusCode = 200)
    {
        return response()->json([
            "success"=>true,
            "message"=>$message,
            "data"=>(object)$data,
            "errors"=>(object)[]
        ],$statusCode);
    }
}
