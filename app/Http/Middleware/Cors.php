<?php 

namespace App\Http\Middleware;

use Closure;

class Cors 
{
    public function handle($request, Closure $next)
    {
        // header("Access-Control-Allow-Origin: *");
        // //ALLOW OPTIONS METHOD
        // $headers = [
        //     'Access-Control-Allow-Methods' => 'POST,GET,OPTIONS,PUT,DELETE',
        //     'Access-Control-Allow-Headers' => 'Accept, Content-Type, X-Auth-Token, Origin, Authorization',
        // ];
        // if ($request->getMethod() == "OPTIONS"){
        //     //The client-side application can set only headers allowed in Access-Control-Allow-Headers
        //     return response()->json('OK', 200, $headers);
        // }
        // $response = $next($request);
        // foreach ($headers as $key => $value) {
        //     $response->header($key, $value);
        // }

        // return $response;

        return $next($request)
            ->header('Allow-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE')
            ->header('Access-Control-Allow-Headers', 'Accept, Content-Type, Authorization, X-CSRF-Token');
    }
}