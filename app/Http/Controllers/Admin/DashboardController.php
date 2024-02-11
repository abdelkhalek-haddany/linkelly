<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Distination;
use App\Models\Stats;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $browsers = \DB::select('select count(*) as count, browser from distination_statistics group by browser');
        $monthlyStats = Stats::selectRaw('SUBSTRING(MONTHNAME(created_at),1,3) as month , YEAR(created_at) as year, count(*) as count')->groupBy('year', 'month')->orderBy('year', 'desc')->orderBy('month', 'desc')->get();
        $monthlyUsers = User::selectRaw('SUBSTRING(MONTHNAME(created_at),1,3) as month , YEAR(created_at) as year, count(*) as count')->groupBy('year', 'month')->orderBy('year', 'desc')->orderBy('month', 'desc')->get();
        $data = Stats::selectRaw('city, longitude, latitude')->whereNot('longitude', null)->whereNot('latitude', null)->get();
        // return $data;
        try {
            if (Auth::check()) {
                if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'super-admin') {
                    return view('pages.admin.dashboard', compact('browsers', 'monthlyStats', 'monthlyUsers', 'data'));
                } else {
                    return view('pages.user.dashboard');
                }
            } else {
                return redirect()->route('login');
            }
        } catch (Exception $e) {
            return redirect()->route('welcome');
        }
    }
    // public function admin_dashboard()
    // {
    //     try {
    //         if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'super-admin') {
    //             return view('pages.admin.dashboard');
    //         } else {
    //             return redirect()->route('welcome');
    //         }
    //     } catch (Exception $e) {
    //         return redirect()->route('welcome');
    //     }
    // }

    // public function user_dashboard()
    // {
    //     try {
    //         if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'super-admin') {
    //             return view('pages.user.dashboard');
    //         } else {
    //             return redirect()->route('welcome');
    //         }
    //     } catch (Exception $e) {
    //         return redirect()->route('welcome');
    //     }
    // }
}
