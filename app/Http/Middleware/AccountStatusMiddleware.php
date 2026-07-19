<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AccountStatusMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Administrators bypass validation status checks
            if ($user->isAdmin()) {
                return $next($request);
            }

            $route = $request->route()->getName();

            // Redirect based on validation status
            if ($user->validation_status === 'pending') {
                if ($route !== 'account.pending' && $route !== 'logout') {
                    return redirect()->route('account.pending');
                }
            } elseif ($user->validation_status === 'rejected') {
                if ($route !== 'account.rejected' && $route !== 'account.resubmit' && $route !== 'logout') {
                    return redirect()->route('account.rejected');
                }
            } else {
                // If validated, don't allow accessing pending/rejected status pages
                if ($route === 'account.pending' || $route === 'account.rejected') {
                    return redirect()->route('dashboard');
                }
            }
        }

        return $next($request);
    }
}
