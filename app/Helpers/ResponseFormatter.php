<?php

namespace App\Helpers;

/**
 * Format response.
 */
class ResponseFormatter
{
    public static $successRetrieve      = 200;
    public static $successCreate        = 201;
    public static $successDelete        = 204;
    public static $errorNotFound        = 404;
    public static $errorUnauthorized    = 401;
    public static $error                = 400;
    public static $toManyRequest        = 429;
    /**
     * Give success response.
     */
    public static function success($data = null, $message = 'ok!', $code = 200)
    {
        $response = [
            'message' => empty($message) ? 'ok!' : $message,
        ];

        if(isset($data['queries'])){
            $response['queries'] = $data['queries'];
            unset($data['queries']);
        }

        if(is_array($data) || !empty($data)){
            $response['data'] = $data;
        }

        return response()->json($response, empty($code) ? self::$successCreate : $code);
    }

    /**
     * Give error response.
     */
    public static function error($message = null, $code = 400, $data = null)
    {
        $response = [
            'message' => $message,
        ];
        if(!empty($data))
            $response['data'] = $data;
        return response()->json($response, $code);
    }

    /**
     * Give datatable format response
     */
    public static function datatable($request, $collection = []){
        $draw            = $request->draw ?? null;
        if(!is_array($collection))
            return self::error(null, 'data must be array');
        $data            = array_key_exists('data', $collection) ? $collection['data'] : [];
        $recordsTotal    = array_key_exists('records_total', $collection) ? $collection['records_total'] : 0;
        $recordsFiltered = array_key_exists('records_filtered', $collection) ? $collection['records_filtered'] : 0;
        $firstUrl        = array_key_exists('first_url', $collection) ? $collection['first_url'] : null;
        $prevUrl         = array_key_exists('prev_url', $collection) ? $collection['prev_url'] : null;
        $nextUrl         = array_key_exists('next_url', $collection) ? $collection['next_url'] : null;
        $lastUrl         = array_key_exists('last_url', $collection) ? $collection['last_url'] : null;

        $response = [
            'data'             => $data,
            'records_filtered' => $recordsFiltered,
            'records_total'    => $recordsTotal,
        ];
        if(!empty($draw))
            $response['draw'] = $draw;
        if(!empty($firstUrl))
            $response['first_url'] = $firstUrl;
        if(!empty($prevUrl))
            $response['prev_url'] = $prevUrl;
        if(!empty($nextUrl))
            $response['next_url'] = $nextUrl;
        if(!empty($lastUrl))
            $response['last_url'] = $lastUrl;
        if(array_key_exists('queries', $collection))
            $response['queries'] = $collection['queries'];
        if(array_key_exists('input', $collection))
            $response['input'] = $collection['input'];
        return response()->json($response);
    }
}
