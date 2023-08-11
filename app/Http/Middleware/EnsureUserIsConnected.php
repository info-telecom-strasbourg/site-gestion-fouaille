<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsConnected
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!cas()->isAuthenticated())
        {
            session()->put([
                'message' => 'Vous n\'êtes pas autorisé à accéder à cette page.',
                'failed' => true
            ]);
            return redirect()->route('home');
        }

        return $next($request);
    }
}
