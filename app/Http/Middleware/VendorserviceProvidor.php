<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VendorserviceProvidor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
    config(['auth.guards.api.provider' => 'vendor_user']);
    return $next($request);
    }
}
