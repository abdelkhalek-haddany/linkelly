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


    public function create()
    {
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

    public function edit(Link $link)
    {
        if (!$link)
            return redirect()->back()->with(['error' => 'This link not exists.']);
        return view('pages.user.links.edite', compact('link'));
    }

    public function store(Request $request)
    {
        try {
            $link = new Link();
            $link->slug = $this->generateRandomStringId();
            $link->user_id = Auth::id();
            $link->status = '0';
            $link->save();
            $i = 0;
            foreach ($request->distinations as $distination) {
                $distination = new Distination();
                $distination->link_id = $link->id;
                $distination->distination = $request->distinations[$i];
                $distination->percentage = $request->percentages[$i];
                $distination->save();
                $i++;
            }
            return redirect()->route('links.index')->with(['success' => 'Link Added Successfully']);
        } catch (Exception $e) {
            return redirect()->route('links.index')->with(['error' => '!Ooops error!']);
        }
    }

    public function update(Request $request, Link $link)
    {
        // try {
            if (!$link)
                return redirect()->back()->with(['error' => 'This link not exists.']);
            // Delete existing destinations
        
            if (isset($link->distinations))
                $dists = Distination::where('link_id', $link->id)->delete();
            // Add updated destinations
            $i = 0;
            foreach ($request->distinations as $distination) {
                $newDistination = new Distination();
                $newDistination->link_id = $link->id;
                $newDistination->distination = $request->distinations[$i];
                $newDistination->percentage = $request->percentages[$i];
                $newDistination->save();
                $i++;
            }

            return redirect()->route('links.index')->with(['success' => 'Link Updated Successfully']);
        // } catch (Exception $e) {
        //     return redirect()->back()->with(['error' => '!Ooops error!']);
        // }
    }

    public function delete($id)
    {
        $link = Link::find($id);
        if ($link) {
            // if (isset($link->distinations->stats))
            //     $link->distinations->stats->delete();
            // if (isset($link->distinations))
            //     $link->distinations->delete();
            $link->delete();
            return redirect()->route('links.index')->with(['success' => 'deleted successfully', 200]);
        }
    }


    public function status($id)
    {
        $link = Link::where('id', $id)->get()->first();
        $link->update([
            'status' => $link->status != '0' ? '0' : '1',
        ]);
        return redirect()->route('links.index')->with(['success' => 'Status changed Successfully']);
    }
}
