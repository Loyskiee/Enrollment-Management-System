<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     * 
     *  check if the specific rolem if it doesn't match abort.
     */
    public function handle(Request $request, Closure $next,): Response
    {
       if(request()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
       }
        return $next($request);
    }
}
