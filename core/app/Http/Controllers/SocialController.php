<?php

namespace App\Http\Controllers;

use App\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $socials = Social::all();
        return view('admin.front.social', compact('socials'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
           [
               'icon' => 'required',
               'url' => 'required',
           ]);
        $social['icon'] = $request->icon;
        $social['url'] = $request->url;
        Social::create($social);

        return back()->with('success', 'New Social Link Created');
    }


    public function update(Request $request, Social $social)
    {
       $this->validate($request,
           [
               'icon' => 'required',
               'url' => 'required',
           ]);
        $social['icon'] = $request->icon;
        $social['url'] = $request->url;
        $social->save();

        return back()->with('success', 'Social Link Updated');
    }

    public function destroy(Social $social)
    {
        $social->delete();
        return back()->with('success', 'Social Link Deleted');
    }
}
