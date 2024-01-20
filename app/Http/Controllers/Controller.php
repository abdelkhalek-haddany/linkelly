<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function welcome()
    {
        return view('pages.user.links.index');
        // return redirect()->route('links.index');

        // try {
        //     if (Auth::check()) {
        //         // if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'super-admin') {
        //         //     return redirect()->route('pages.admin.dashboard');
        //         // } else {
        //         return redirect()->route('pages.links.index');
        //         // }
        //     } else {
        //         return redirect()->route('login');
        //     }
        // } catch (Exception $e) {
        //     return redirect()->route('welcome');
        // }
    }
}
