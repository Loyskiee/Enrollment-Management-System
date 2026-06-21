<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     * 
     *  Check if the logged in user is admin
     *     if not, abort 
     */
    public function handle(Request $request, Closure $next,): Response
    {
       if($request->user()->role !== UserRole::Admin) {
            abort(403, 'Unauthorized access.');
       }
        return $next($request);
    }
}
