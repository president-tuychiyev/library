<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
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
                session()->put('user', $user);
                return redirect()->route('admin.home');
            else:
                return redirect()->back()->with('msg', __('locale.msg.auth.error', ['text' => 'Parol']));
            endif;
        else:
            return redirect()->back()->with('msg', __('locale.msg.auth.error', ['text' => 'Email']));
        endif;
    }

    public function logout()
    {
        session()->pull('user');
        return redirect()->back();
    }

    public function sendCodeEmail()
    {
        $user = User::where('email', request()->email)->first();
        if (!$user):
            $verify = Verification::create(['email' => request()->email, 'code' => substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 6)]);
            return redirect()->route('auth.registration', $verify->id);
        else:
            return redirect()->back()->with('msg', __('locale.msg.auth.error', ['text' => 'Email']));
        endif;
    }

    public function registration()
    {
        return view('auth.registration');
    }
}
