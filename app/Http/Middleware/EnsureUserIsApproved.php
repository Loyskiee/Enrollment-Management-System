<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class EnsureUserIsApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     *  
     * Check if the logged in user is approved
     *  if not, logout and redirect to login with error message
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if(Auth::check() && Auth::user()->status !== 'approved') {
            Auth::logout();

            return redirect('/login')->with('error', 'Your account is not approved yet.');
        }
        
        return $next($request);
    }
}
