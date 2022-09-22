<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function workmansIndex()
    {
        $workmans = User::where('id', '!=', session()->get('user')->id)->where('isDeleted', false)->with('media')->with('role')->with('user')->paginate(10);
        $roles = Role::where('isDeleted', false)->get();
        return view('interfaces.admin.workmans', compact('workmans', 'roles'));
    }

    public function workmansAdd()
    {
        request()->validate([
            'email' => 'required|unique:users|max:30',
            'pass' => 'required|max:9',
        ],
            [
                'email.unique' => 'Bunday emailga ega foydalanuvchi mavjud!',
            ]);

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

        return redirect()->back()->with('msg', __('lang.adding.success'));
    }

    public function workmansUpdate()
    {
        $workman = User::where('users.id', request()->id)->with('media')->first();
        request()->isActiveCheck ? request()->request->add(['isActive' => true]) : request()->request->add(['isActive' => false]);
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
        
        return redirect()->back()->with('msg', __('lang.update.success'));
    }

    public function workmansDelete($id)
    {
        User::where('id', $id)->update([ 'isDeleted' => true, 'email' => User::find($id)->email . "-{$id}" ]);

        return redirect()->back()->with('msg', __('lang.delete.success'));
    }
}