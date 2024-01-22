<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Distination;
use App\Models\Link;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;

class LinksController extends Controller
{
    public function index()
    {
        try {
            if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'supper-admin') {
                $links = Link::all();
                return view('pages.user.links.index', ['links' => $links]);
            } else {
                $links = Link::where('user_id', Auth::id())->get();
                return view('pages.user.links.index', ['links' => $links]);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => '!Ooops error!']);
        }
    }


    public function create(){
        return view('pages.user.links.create');
    }
    function generateRandomStringId($length = 10)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $stringId = '';

        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, strlen($characters) - 1);
            $stringId .= $characters[$randomIndex];
        }

        return $stringId;
    }

    public function store(Request $request)
    {
        try {
            $link = new Link();
            $link->name = $request->name;
            $link->url = $request->url;
            $link->slug = $this->generateRandomStringId();
            $link->user_id = Auth::id();
            $link->status = 0;
            $link->save();
            $i = 0;
            foreach ($request->distinations as $distination) {
                $distination = new Distination();
                $distination->link_id = $link->id;
                $distination->distination = $distination;
                $distination->percentage = $request->percentages[$i];
                $distination->save();
                $i++;
            }
            return redirect()->route('user.links.index')->with(['success' => 'Link Added Successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => '!Ooops error!']);
        }
    }
}
