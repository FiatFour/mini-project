<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function responseValidateFailed($validator)
    {
        return response()->json([
            'success' => false,
            'message' => $validator->getMessageBag()->first()
        ], 422);
    }
    function responseValidateAllFailed($validator)
    {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ]);
    }

    function responseValidateSuccess($redirect)
    {
        return response()->json([
            'success' => true,
            'message' => 'ok',
            'redirect' => $redirect
        ]);
    }

    function responseComplete()
    {
        return response()->json([
            'success' => true,
            'message' => 'Complete',
        ]);
    }

    function responseFailed($message = 'Complete')
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ]);
    }
    function responseEmpty($message)
    {
        return response()->json([
            'success' => false,
            'message' => $message . 'not found',
        ]);
    }
    function responseDeletedSuccess($message, $redirect)
    {
        return response()->json(['success' => true,
            'message' => $message . 'deleted successfully',
            'redirect' => route($redirect)
        ]);
    }
}
