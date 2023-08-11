<?php

namespace App\Http\Helpers;

class ResponseHelper
{
    public static function ok( $data, $statusCode = 200 )
    {
        return response()->json( [
            'data'       => $data,
            'statusCode' => $statusCode
        ], $statusCode );
    }

    public static function error( $errorMsg, $errorCode = 400 )
    {
        return response()->json( [
            'error'      => $errorMsg,
            'statusCode' => $errorCode
        ], $errorCode );
    }
}
