<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Role;
use App\Models\System;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function workmansIndex()
    {
        $workmans = User::where('id', '!=', session()->get('user')->id)->where('isDeleted', false)->whereNotIn('roleId', [1, 2, 3])->with('media')->with('role')->with('user')->paginate(10);
        $roles = Role::where('isDeleted', false)->whereNotIn('id', [1, 2, 3])->get();
        return view('interfaces.admin.workmans', compact('workmans', 'roles'));
    }

    public function workmansAdd()
    {
        request()->validate(
            [
                'email' => 'required|unique:users|max:30',
                'pass' => 'required',
            ],
            [
                'email.unique' => 'Bunday emailga ega foydalanuvchi mavjud!',
            ]
        );

        request()->isActiveCheck ? request()->request->add(['userId' => session()->get('user')->id, 'isActive' => true]) : request()->request->add(['userId' => session()->get('user')->id]);
        request()->request->add(['password' => Hash::make(request()->pass)]);
        if (request()->hasFile('avatar')):
            $avatar = Storage::disk('upload')->put('upload/avatars', request()->file('avatar'));
            $pathInfo = pathinfo($avatar);
            $media = Media::create([
                'baseName' => $pathInfo['basename'],
                'fullPath' => $avatar,
                'type' => $pathInfo['extension'],
            ]);
            request()->request->add(['mediaId' => $media->id]);
        endif;

        User::create(request()->except(['avatar', 'isActiveCheck', 'id', 'pass']));

        return redirect()->back()->with('msg', __('locale.msg.insert.success'));
    }

    public function workmansUpdate()
    {
        $workman = User::where('users.id', request()->id)->with('media')->first();
        request()->isActiveCheck ? request()->request->add(['isActive' => true]) : request()->request->add(['isActive' => $workman->isActive]);
        is_null(request()->pss) ? '' : request()->request->add(['password' => Hash::make(request()->pass)]);
        if (request()->hasFile('avatar')):
            $avatar = Storage::disk('upload')->put('upload/avatars', request()->file('avatar'));
            $pathInfo = pathinfo($avatar);
            if ($workman->mediaId != 1):
                Storage::disk('upload')->delete($workman->media->fullPath);
                Media::where('id', $workman->mediaId)->update([
                    'baseName' => $pathInfo['basename'],
                    'fullPath' => $avatar,
                    'type' => $pathInfo['extension'],
                ]);
            else:
                $media = Media::create([
                    'baseName' => $pathInfo['basename'],
                    'fullPath' => $avatar,
                    'type' => $pathInfo['extension'],
                ]);
                request()->request->add(['mediaId' => $media->id]);
            endif;
        endif;

        User::where('id', request()->id)->update(request()->except(['avatar', 'isActiveCheck', 'id', 'pass', '_token']));

        return redirect()->back()->with('msg', __('locale.msg.update.success'));
    }

    public function workmansDelete($id)
    {
        User::where('id', $id)->where('id', '!=', 1)->update(['isDeleted' => true, 'email' => User::find($id)->email . "-{$id}"]);
        return redirect()->back()->with('msg', __('locale.msg.delete.success'));
    }

    public function workmansSearch()
    {
        $workmans = User::where('id', '!=', session()->get('user')->id)
            ->where('isDeleted', false)->whereNotIn('roleId', [1, 2, 3])
            ->orWhere('id', 'like', request()->q)
            ->orWhere('name', 'like', request()->q)
            ->orWhere('email', 'like', request()->q)
            ->with('media')->with('role')->with('user')->paginate(10);
        $roles = Role::where('isDeleted', false)->whereNotIn('id', [1, 2, 3])->get();
        return view('interfaces.admin.workmans', compact('workmans', 'roles'));
    }

    public function teachers()
    {
        $users = User::where('id', '!=', session()->get('user')->id)->where('isDeleted', false)->where('roleId', 2)->with('media')->with('user')->paginate(30);
        $role = 2;
        return view('interfaces.admin.users-others', compact('users', 'role'));
    }

    public function students()
    {
        $users = User::where('id', '!=', session()->get('user')->id)->where('isDeleted', false)->where('roleId', 3)->with('media')->with('user')->paginate(30);
        $groups = System::where('isDeleted', false)->where('isActive', true)->get();
        $role = 3;
        return view('interfaces.admin.users-others', compact('users', 'role', 'groups'));
    }

    public function usersAdd()
    {
        request()->validate(
            [
                'email' => 'required|unique:users|max:30',
                'pass' => 'required',
            ],
            [
                'email.unique' => 'Bunday emailga ega foydalanuvchi mavjud!',
            ]
        );

        request()->isActiveCheck ? request()->request->add(['userId' => session()->get('user')->id, 'isActive' => true]) : request()->request->add(['userId' => session()->get('user')->id]);
        request()->request->add(['password' => Hash::make(request()->pass)]);
        if (request()->hasFile('avatar')):
            $avatar = Storage::disk('upload')->put('upload/avatars', request()->file('avatar'));
            $pathInfo = pathinfo($avatar);
            $media = Media::create([
                'baseName' => $pathInfo['basename'],
                'fullPath' => $avatar,
                'type' => $pathInfo['extension'],
            ]);
            request()->request->add(['mediaId' => $media->id]);
        endif;

        User::create(request()->except(['avatar', 'isActiveCheck', 'id', 'pass']));

        return redirect()->back()->with('msg', __('locale.msg.insert.success'));
    }

    public function usersUpdate()
    {
        $user = User::where('users.id', request()->id)->with('media')->first();
        request()->isActiveCheck ? request()->request->add(['isActive' => true]) : request()->request->add(['isActive' => $user->isActive]);
        is_null(request()->pss) ? '' : request()->request->add(['password' => Hash::make(request()->pass)]);
        if (request()->hasFile('avatar')):
            $avatar = Storage::disk('upload')->put('upload/avatars', request()->file('avatar'));
            $pathInfo = pathinfo($avatar);
            if ($user->mediaId != 1):
                Storage::disk('upload')->delete($user->media->fullPath);
                Media::where('id', $user->mediaId)->update([
                    'baseName' => $pathInfo['basename'],
                    'fullPath' => $avatar,
                    'type' => $pathInfo['extension'],
                ]);
            else:
                $media = Media::create([
                    'baseName' => $pathInfo['basename'],
                    'fullPath' => $avatar,
                    'type' => $pathInfo['extension'],
                ]);
                request()->request->add(['mediaId' => $media->id]);
            endif;
        endif;

        User::where('id', request()->id)->update(request()->except(['avatar', 'isActiveCheck', 'id', 'pass', '_token']));

        return redirect()->back()->with('msg', __('locale.msg.update.success'));
    }

    public function usersDelete($id)
    {
        User::where('id', $id)->where('id', '!=', 1)->update(['isDeleted' => true, 'email' => User::find($id)->email . "-{$id}"]);
        return redirect()->back()->with('msg', __('locale.msg.delete.success'));
    }

    public function check()
    {
        $user = User::where(['isDeleted' => false, 'isActive' => true, 'id' => request()->id])->with(['user', 'role', 'media', 'system', 'order'])->first();
        if (!$user) {
            return response()->json("Bunday foydalanuvchi topilmadi!", 210);
        }

        return response()->json($user, 200);
    }

    public function search($role)
    {
        $users = User::where('roleId', $role)->where('id', '!=', session()->get('user')->id)->where('isDeleted', false)
            ->orWhere('id', 'like', request()->q)
            ->orWhere('name', 'like', request()->q)
            ->orWhere('email', 'like', request()->q)
            ->with('media')->with('user')->paginate(30);
        $role = $role;
        return view('interfaces.admin.users-others', compact('users', 'role'));
    }
}
