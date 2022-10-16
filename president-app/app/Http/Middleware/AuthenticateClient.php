<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AuthenticateClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('client') && $request->path() != app()->getLocale() . '/auth/sign-in'):
            return redirect()->route('auth.signIn')->with('msg', __('locale.msg.auth.warning'));
        endif;

        if (session()->has('client') && $request->path() == app()->getLocale() . '/auth/sign-in'):
            return redirect()->route('client.home');
        endif;

        return $next($request);
    }
}