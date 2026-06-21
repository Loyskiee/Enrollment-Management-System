<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\UserRole;
use App\Enums\UserStatus;
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
     * Check if the user the user, admin, and approved
     *  redirect to dashboard (logic is in routes)
     *  if not, redirect to login with error message.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * Auth::check() - Verifies is the user is already authenticated. Doesn't required credentials.
         * Auth::attempt() - User tries to login. Requires credentials.
         */
        
        if ( Auth::check() &&
            Auth::user()->role !== UserRole::Admin &&
            Auth::user()->status !== UserStatus::Approved
            ) {
            Auth::logout();

            return redirect()
                ->route('login')
                ->with('status', 'Your account is pending approval by the registrar.');
        }
    
        return $next($request);
    }
}
