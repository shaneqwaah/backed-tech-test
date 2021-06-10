<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;


class ResponseController extends Controller
{

    /**
     * return success response.
     *
    //     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message): \Illuminate\Http\JsonResponse
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
    //     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 500): \Illuminate\Http\JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

}
