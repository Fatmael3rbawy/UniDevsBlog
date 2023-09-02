<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class BaseResponse extends Controller
{
    public function response($code, $message, $statusCode, $validations = [], $object = null)
    {
        return response()->json(['code' => $code, 'message' => $message, 'validation' => $validations,
             'data' => $object], $statusCode);
    }
}
