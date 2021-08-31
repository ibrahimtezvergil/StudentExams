<?php

namespace App\Http\Controllers;


/**
 * Class AppBaseController
 * @package App\Http\Controllers
 */
class AppBaseController extends Controller
{
    /**
     * @param $data
     * @param string|null $message
     * @param bool $success
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($data,?string $message, $success = true)
    {
        $result = [
            'data' => $data,
            'message' => $message,
            'success' => $success
        ];
        return response()->json($result);
    }

    /**
     * @param string|null $message
     * @param false $success
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError(?string $message, $success = false)
    {
        $result = [
            'message' => $message,
            'success' => $success
        ];
        return response()->json($result);
    }
}
