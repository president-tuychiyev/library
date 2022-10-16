<?php

namespace App\View\Components\Client;

use App\Models\Menu;
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
        $menus = Menu::where('isActive', true)->where('user', true)->where('parentId', null)->where('route', null)->select('menus.id', 'menus.parentId', "menus.name{$lang} as name", 'menus.icon', 'menus.route')->orderBy('turn', 'asc')->get();
        $submenus = Menu::where('isActive', true)->where('user', true)->whereNotNull('parentId')->select('menus.id', 'menus.parentId', "menus.name{$lang} as name", 'menus.icon', 'menus.route')->orderBy('turn', 'asc')->get();
        $openmenus = Menu::where('isActive', true)->where('user', true)->where('parentId', null)->whereNotNull('route')->select('menus.id', 'menus.parentId', "menus.name{$lang} as name", 'menus.icon', 'menus.route')->orderBy('turn', 'asc')->get();
        return view('components.client.sidebar', compact('menus', 'submenus', 'openmenus'));
    }
}
