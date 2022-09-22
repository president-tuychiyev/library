<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Permissions
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
        $route = Route::getRoutes()->match($request);
        $menu = Menu::where('route', str_replace(['.add', '.update', '.delete'], ['', '', ''], $route->getName()))->first();

        if ($menu):
            $permission = Role::where('id', session()->get('user')->role->id)->with('permission')->first()->permission->where('menuId', $menu->id)->first();
            if (in_array('add', $request->segments())):
                // this is add permission
                if (!$permission->create): return redirect()->back()->with('msg', __('lang.adding.error'));endif;
            elseif (in_array('update', $request->segments())):
                // this is update permission
                if (!$permission->update): return redirect()->back()->with('msg', __('lang.update.error'));endif;
            elseif (in_array('delete', $request->segments())):
                // this is delete permission
                if (!$permission->delete): return redirect()->back()->with('msg', __('lang.delete.error'));endif;
            endif;
        endif;

        return $next($request)->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat 01 Jan 1990 00:00:00 GMT');
    }
}
