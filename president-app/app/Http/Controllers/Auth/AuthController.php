<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\MailNotify;
use App\Models\System;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function index()
    {
        if (session()->has('admin')): return redirect()->route('admin.home');elseif (session()->has('client')): return redirect()->route('client.home');endif;
        return view('auth.sign-in');
    }

    public function check(Request $request)
    {
        $request->validate([
            'email' => 'required|string|min:5|max:50',
            'password' => 'required|string|min:6|max:20',
        ]);
        $user = User::where('isDeleted', false)->where('isActive', true)->where('email', $request->email)->with('role')->with('media')->first();
        if ($user):
            if (Hash::check($request->password, $user->password)):
                if (in_array($user->roleId, [2, 3])): session()->put('client', $user);return redirect()->route('client.home');endif;
                session()->put('admin', $user);
                return redirect()->route('admin.home');
            endif;
            return redirect()->back()->with('msg', __('locale.msg.auth.error', ['text' => 'Parol']));

        endif;
        return redirect()->back()->with('msg', __('locale.msg.auth.error', ['text' => 'Email']));

    }

    public function logout()
    {
        if (session()->has('admin')): session()->pull('admin');else:session()->pull('client');endif;
        return redirect()->back();
    }

    public function sendCodeEmail()
    {
        $user = User::where('email', request()->email)->first();
        if (!$user):
            Verification::where('email', request()->email)->delete();
            $verify = Verification::create(['email' => request()->email, 'code' => substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 6)]);

            $data = [
                'subject' => "Qo'qon universiteti elektron kutibhonasi",
                'code' => $verify->code,
            ];
            Mail::to(request()->email)->send(new MailNotify($data));

            return redirect()->route('auth.registration', $verify->id);
        else:
            return redirect()->back()->with('msg', __('locale.msg.auth.error', ['text' => 'Email']));
        endif;
    }

    public function registration()
    {
        $groups = System::where('isDeleted', false)->where('isActive', true)->get();
        $userId = request()->id;
        return view('auth.registration', compact('groups', 'userId'));
    }

    public function createProfile()
    {
        $verify = Verification::where('id', request()->verifyId)->where('code', request()->verifyCode)->first();
        if ($verify):
            request()->request->add(['email' => $verify->email, 'isActive' => true, 'userId' => 1, 'roleId' => request()->position, 'password' => Hash::make(request()->pass)]);
            User::create(request()->except(['_token', 'verifyId', 'position', 'switches-square-stacked-radio', 'pass', 'verifyCode']));
            $verify->delete();
            return redirect()->route('auth.signIn')->with('msg', __('locale.msg.auth.warning'));
        else:
            return redirect()->back();
        endif;
    }

    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        $google = Socialite::driver('google')->user();
        $user = User::where('isDeleted', false)->where('isActive', true)->where('email', $google->email)->with('role')->with('media')->first();

        if ($user):
            if (in_array($user->roleId, [2, 3])): session()->put('client', $user);return redirect()->route('client.home');endif;
            session()->put('admin', $user);
            return redirect()->route('admin.home');
        else:
            return redirect()->route('auth.signIn')->with('msg', __('locale.msg.auth.error', ['text' => 'Email']));
        endif;

    }
}
