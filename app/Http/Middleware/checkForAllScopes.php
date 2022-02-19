<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkForAllScopes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, $next, ...$scopes)
    {
        //$request->headers->set('Accept', 'application/json');
        if (! $request->user() || ! $request->user()->token()) {
            return response(['data'=>["Not Authorized."],"message"=>"User is not authorized.","status"=>'failed'], 403 );
        }
            
        foreach ($scopes as $scope) {
            if ($request->user()->tokenCan($scope)) {
                return $next($request);
            }
        }

        return response(['data'=>["Not Authorized."],"message"=>__("auth.unauthorized"),"status"=>'failed'], 403 );
    
    }
}
