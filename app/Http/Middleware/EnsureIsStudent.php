<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     * 
     *  Check if the logged in user is student
     *     if not, abort
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->role !== UserRole::Student) {
            abort(403, 'Unauthorized access.');
        }
        return $next($request);
    }
}
