<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::where('isDeleted', false)->with('user')->with('permission')->get();
        $users = User::where('isDeleted', false)->get();
        $menus = Menu::where('isActive', true)->where('admin', true)->whereNotNull('route')->get();
        return view('interfaces.admin.roles', compact('roles', 'users', 'menus'));
    }

    public function add()
    {
        request()->isActiveCheck ? request()->request->add(['userId' => session()->get('user')->id, 'isActive' => true]) : request()->request->add(['userId' => session()->get('user')->id]);
        $role = Role::create(request()->except(['menu', 'id', '_token']));
        $menus = Menu::where('admin', true)->whereNotNull('route')->get();
        foreach ($menus as $m):
            Permission::create(
                [
                    'roleId' => $role->id,
                    'menuId' => $m->id,
                ]
            );
        endforeach;
        foreach (request()->menu as $key => $val):
            $permission = [];
            foreach ($val as $k => $v):
                $permission = $permission + [$k => true];
            endforeach;
            Permission::where('roleId', $role->id)->where('menuId', $key)->update($permission);
        endforeach;
        return redirect()->back()->with('msg', __('lang.adding.success'));
    }

    public function update()
    {
        request()->isActiveCheck ? request()->request->add(['isActive' => true]) : request()->request->add(['isActive' => false]);
        $role = Role::find(request()->id);
        Role::where('id', request()->id)->update(request()->except(['menu', 'id', '_token']));
        foreach (request()->menu as $key => $val):
            $permission = [];
            foreach ($val as $k => $v):
                $permission = $permission + [$k => true];
            endforeach;
            Permission::where('roleId', $role->id)->where('menuId', $key)->update($permission);
        endforeach;
        return redirect()->back()->with('msg', __('lang.update.success'));
    }

    public function delete($id)
    {
        Role::where('id', $id)->update(['isDeleted' => true]);

        return redirect()->back()->with('msg', __('lang.delete.success'));
    }
}
