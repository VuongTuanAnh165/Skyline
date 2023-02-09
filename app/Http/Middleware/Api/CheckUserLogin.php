<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AbstractApiController;

class CheckUserLogin
{
    protected $response;

    public function __construct(AbstractApiController $response)
    {
        $this->response = $response;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->tokenCan('user')) {
            return $this->response->respondUnauthorized() ;
        }
        return $next($request);
    }
}
