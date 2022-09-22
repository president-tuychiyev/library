<?php

namespace App\View\Components;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $lang = app()->getLocale();
        $permission = Role::where('id', session()->get('user')->role->id)->with('permission')->first()->permission->where('read', 1);
        foreach ($permission as $p):
            $perWhere[] = $p->menuId;
        endforeach;
        $menus = Menu::where('isActive', true)->where('admin', true)->where('parentId', null)->where('route', null)->select('menus.id', 'menus.parentId', "menus.name{$lang} as name", 'menus.icon', 'menus.route')->orderBy('turn', 'asc')->get();
        $submenus = Menu::where('isActive', true)->where('admin', true)->whereNotNull('parentId')->whereIn('id', $perWhere)->select('menus.id', 'menus.parentId', "menus.name{$lang} as name", 'menus.icon', 'menus.route')->orderBy('turn', 'asc')->get();
        $openmenus = Menu::where('isActive', true)->where('admin', true)->where('parentId', null)->whereNotNull('route')->whereIn('id', $perWhere)->select('menus.id', 'menus.parentId', "menus.name{$lang} as name", 'menus.icon', 'menus.route')->orderBy('turn', 'asc')->get();
        return view('components.sidebar', compact('menus', 'submenus', 'openmenus'));
    }
}