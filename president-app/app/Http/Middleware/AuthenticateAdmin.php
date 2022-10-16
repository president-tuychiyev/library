<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AuthenticateAdmin
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
        if (!session()->has('admin') && $request->path() != app()->getLocale() . '/auth/sign-in'):
            return redirect()->route('auth.signIn')->with('msg', __('locale.msg.auth.warning'));
        endif;

        if (session()->has('admin') && $request->path() == app()->getLocale() . '/auth/sign-in'):
            return redirect()->route('admin.home');
        endif;

        return $next($request);
    }
}
