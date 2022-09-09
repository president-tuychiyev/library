<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Detail;
use App\Models\System;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function index()
    {
        $facultys = Detail::where('type', 9)->where('isDeleted', false)->with('user')->paginate(10,['*'],'facultys');
        $departaments = Detail::where('type', 10)->where('isDeleted', false)->with('user')->paginate(10,['*'],'departaments');
        $groups = System::where('isDeleted', false)->with('user')->paginate(10,['*'],'groups');
        return view('interfaces.admin.system', compact('facultys', 'departaments', 'groups'));
    }

    public function add()
    {
        request()->request->remove('id');
        request()->isActiveCheck ? request()->request->add(['userId' => session()->get('user')->id, 'isActive' => true]) : request()->request->add(['userId' => session()->get('user')->id]);
        request()->request->remove('isActiveCheck');
        System::create(request()->all());
        return redirect()->back()->with('msg', __('lang.adding.success'));
    }

    public function update()
    {
        $id = request()->groupId;
        request()->request->remove('_token');
        request()->request->remove('groupId');
        request()->isActiveCheck ? request()->request->add(['isActive' => true]) : request()->request->add(['isActive' => false]);
        request()->request->remove('isActiveCheck');
        System::where('id', $id)->update(request()->all());
        return redirect()->back()->with('msg', __('lang.update.success'));
    }

    public function delete($id)
    {
        System::where('id', $id)->update([ 'isDeleted' => true ]);

        return redirect()->back()->with('msg', __('lang.delete.success'));
    }
}
