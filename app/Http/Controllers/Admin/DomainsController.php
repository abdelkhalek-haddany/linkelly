<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use Illuminate\Http\Request;

class DomainsController extends Controller
{
    public function index()
    {
        $domains  = Domain::get();
        return view('pages.admin.domains.index', ['domains' => $domains]);
    }

    public function create()
    {
        return view('pages.admin.domains.create');
    }

    public function store(Request $request)
    {
        // try {
        // if ($request->avatar) {
        //     $avatar = UploadImage('uploads/domains', $request->avatar);
        // } else {
        //     $avatar = "";
        // }

        $domain = new  Domain();
        $domain->name = $request->name;
        $domain->domain = $request->domain;
        $domain->status = $request->status;
        $domain->save();

        // if (!Auth::check()) {
        //     Auth::attempt(array('email' => $domain->email, 'password' => $domain->password));
        //     $this->guard()->login($domain);
        //     return redirect()->route('welcome');
        // }
        return redirect()->route('domains.index')->with(['success' => 'Saved Successfully']);
        // } catch (\Exception $ex) {
        //     return redirect()->back()->with(['error' => __('pages/admin/messages.error')]);
        // }
    }

    public function edit($domain)
    {
        $domain = Domain::where('id', $domain)->get()->first();
        return view('pages.admin.domains.edit', compact('domain'));
    }


    public function update(Request $request, Domain $domain)
    {
        // try {
        if (!$domain) return redirect()->back()->with(['error' => '!Oops error']);

        // if ($request->avatar) {
        //     $avatar = UploadImage('uploads/domains', $request->avatar);
        // } else {
        //     $avatar = "";
        // }

        $domain->name = $request->name;
        $domain->domain = $request->domain;
        $domain->status = $request->status;

        $domain->update();
        return redirect()->route('domains.index')->with(['success' => 'Update Successefully']);
        // } catch (\Exception $ex) {
        //     return redirect()->back()->with(['error' => __('pages/admin/messages.error')]);
        // }
    }


    public function delete($id)
    {
        $domain = Domain::find($id);
        if ($domain) {
            $domain->delete();
            return redirect()->route('domains.index')->with(['success' => 'Deleted Successefully', 200]);
        }
    }

    public function status($id, $status)
    {
        $domain = Domain::find($id);
        $domain->status = $status;
        $domain->update();
        return redirect()->route('domains.index')->with(['success' => 'Status Changed Successfully', 200]);
    }
}
