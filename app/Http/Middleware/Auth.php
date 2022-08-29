<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Auth
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
        if (!session()->has('user') && ($request->path() != '/' . app()->getLocale() . '/auth/sign-in' && $request->path() != '/' . app()->getLocale() . '/auth/sign-up')):
            return redirect()->route('auth.signIn');
        endif;

        if (session()->has('user') && ($request->path() == '/' . app()->getLocale() . '/auth/sign-in' && $request->path() == '/' . app()->getLocale() . '/auth/sign-up')):
            return redirect()->back();
        endif;

        return $next($request);
    }
}
