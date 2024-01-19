<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        try {
            if (Auth::check()) {
                if (Auth::user()->user_type == 'admin') {
                    return route('admin.dashboard');
                } else {
                    return route('user.dashboard');
                }
            } else {
                return redirect()->route('login');
            }
        } catch (Exception $e) {
            return redirect()->route('welcome');
        }
    }
    public function admin_dashboard()
    {
        try {
            if (Auth::user()->user_type == 'admin') {
                return view('pages.admin.dashboard');
            } else {
                return redirect()->route('welcome');
            }
        } catch (Exception $e) {
            return redirect()->route('welcome');
        }
    }

    public function user_dashboard()
    {
        try {
            if (Auth::user()->user_type == 'admin') {
                return view('pages.user.dashboard');
            } else {
                return redirect()->route('welcome');
            }
        } catch (Exception $e) {
            return redirect()->route('welcome');
        }
    }
}
