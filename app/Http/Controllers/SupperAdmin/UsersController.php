<?php

namespace App\Http\Controllers\SupperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    use RegistersUsers;

    public function index()
    {
        if ($_GET) {
            if ($_GET['q']) {
                $users  = User::orderBy('created_at', 'DESC')->whereNot('id', Auth::id())->whereNot('user_type', 'super-admin')->where('first_name', 'like', '%' . $_GET['q'] . '%')->orWhere('last_name', 'like', '%' . $_GET['q'] . '%')->get();
            } else {
                $users  = User::orderBy('created_at', 'DESC')->whereNot('id', Auth::id())->whereNot('user_type', 'super-admin')->get();
            }
        } else {
            $users  = User::orderBy('created_at', 'DESC')->whereNot('id', Auth::id())->whereNot('user_type', 'super-admin')->get();
        }

        return view('pages.admin.users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('pages.admin.users.create');
    }

    public function store(Request $request)
    {
        // try {
        // if ($request->avatar) {
        //     $avatar = UploadImage('uploads/users', $request->avatar);
        // } else {
        //     $avatar = "";
        // }
        $user = new  User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->user_type = $request->user_type;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        // if (!Auth::check()) {
        //     Auth::attempt(array('email' => $user->email, 'password' => $user->password));
        //     $this->guard()->login($user);
        //     return redirect()->route('welcome');
        // }
        return redirect()->route('users.index')->with(['success' => __('pages/admin/messages.saved')]);
        // } catch (\Exception $ex) {
        //     return redirect()->back()->with(['error' => __('pages/admin/messages.error')]);
        // }
    }

    public function edit($user)
    {
        $user = User::where('id', $user)->get()->first();
        return view('pages.admin.users.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        // try {
        if (!$user) return redirect()->back()->with(['error' => __('pages/admin/messages.error')]);

        // if ($request->avatar) {
        //     $avatar = UploadImage('uploads/users', $request->avatar);
        // } else {
        //     $avatar = "";
        // }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->user_type = $request->user_type;
        // $user->avatar = $avatar;
        // $user->slugID = Str::slug($request->name . '_' . now());
        // $user->city = $request->city;
        $user->email = $request->email;
        if ($request->password != null)
            $user->password = Hash::make($request->password);
        $user->update();
        return redirect()->route('users.index')->with(['success' => __('pages/admin/messages.updated')]);
        // } catch (\Exception $ex) {
        //     return redirect()->back()->with(['error' => __('pages/admin/messages.error')]);
        // }
    }


    public function change_user_role(Request $request)
    {
        try {
            $user = User::where('id', $request->user_id)->get()->first();
            $user->update(['user_type' => $request->role]);
            return redirect()->route('users.index')->with(['success' => __('pages/admin/messages.updated')]);
        } catch (\Exception $ex) {
            return redirect()->route('users.index')->with(['success' => __('pages/admin/messages.error')]);
        }
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('users.index')->with(['success' => __('pages/admin/messages.deleted'), 200]);
        }
    }

    public function status($id, $status)
    {
        $user = User::find($id);
        $user->status = $status;
        $user->update();

        return redirect()->route('users.index')->with(['success' => __('pages/admin/messages.status_changed')]);
    }
}
