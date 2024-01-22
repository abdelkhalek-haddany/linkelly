<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\ProfileUpdate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function index()
    {
        // return redirect()->route('2fa.index');
        try {
            // $products = Product::where('vendor_id', Auth::id())->get()->all();
            return view('pages.admin.pages.profile.edit');
        } catch (\Exception $ex) {
            return redirect()->route('profile.edit')->with(['error' => __('pages/admin/messages.error')]);
        }
    }

    public function dismiss_model()
    {
        return redirect()->route('profile.edit');
    }
    public function edit()
    {
        try {
            return view('pages.admin.pages.profile.edit');
        } catch (\Exception $ex) {
            return redirect()->route('profile.edit')->with(['error' => __('pages/admin/messages.error')]);
        }
    }


    public function avatar_update(ImageRequest $request)
    {
        try {
            $image = UploadImage($request->image, 'uploads/users');
            $user = User::where('id', Auth::id())->get()->first();
            try {
                if (file_exists($user->avatar())) unlink($user->avatar);
            } catch (\Exception $e) {
                return redirect()->back()->with(['user' => $user]);
            }
            $user->update([
                'avatar' => $image
            ]);
            return redirect()->back()->with(['user' => $user]);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['success' => __('pages/admin/messages.updated')]);
        }
    }

    public function update(ProfileUpdate $request)
    {
        // try {
        $user = User::where('id', Auth::id())->get();
        if ($request->avatar) {
            $avatar = UploadImage($request->avatar, 'uploads/users');
        } else {
            $avatar = $user->avatar;
        }

        $password = $request->password ? Hash::make($request->password) : $user->password;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->avatar = $avatar;
        $user->email = $request->email;
        if ($request->password) {
            if (Hash::make($request->password) == $user->password) {
                return redirect()->route('profile.edit')->with(['same_password' => __('pages/admin/messages.same_password')]);
            }
            if ($request->password != $request->password_confirmation) {
                return redirect()->route('profile.edit')->with(['same_password' => __('pages/admin/messages.confirm_password')]);
            }
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->route('profile.edit')->with(['old_password' => __('pages/admin/messages.old_password')]);
            }
            $user->password = Hash::make($request->password);
        }
        $user->update();
        return redirect()->route('profile.edit')->with(['updated' => __('pages/admin/messages.updated')]);
        // } catch (\Exception $ex) {
        //     return redirect()->route('profile.edit')->with(['error' => __('pages/admin/messages.error')]);
        // }
    }
}
