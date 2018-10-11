<?php

namespace App\Http\Controllers;

use App\Faq;
use App\Frontend;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
  
    public function index()
    {
        $frontend = Frontend::first();
       if(is_null($frontend))
       {
           $default = [
              'footer2' =>0,
           ];
           Frontend::create($default);
           $frontend = Frontend::first();
       }
        $faqs = Faq::all();
        return view('admin.front.faq', compact('faqs','frontend'));
    }

     public function create()
    {
      return view('admin.front.newsection');
    }


    public function store(Request $request)
    {
        $this->validate($request,
           [
               'title' => 'required',
               'color' => 'required',
               'details' => 'required',
           ]);
        $faq['title'] = $request->title;
        $faq['color'] = $request->color;
        $faq['details'] = $request->details;
        Faq::create($faq);

        return redirect()->route('section.index')->with('success', 'New Section Created');
    }

    public function updateSection(Request $request)
    {
        
        $frontend = Frontend::first();
        $frontend['footer2'] = $request->footer2==1?1:0;
        $frontend->save();

        return back()->with('success', 'Section Updated');
    }

    public function edit(Faq $section)
    {
       return view('admin.front.editsection', compact('section'));
    }

    public function update(Request $request, Faq $section)
    {
        $this->validate($request,
           [
               'title' => 'required',
               'color' => 'required',
               'details' => 'required',
           ]);
        $section['title'] = $request->title;
        $section['color'] = $request->color;
        $section['details'] = $request->details;
        $section->save();

        return back()->with('success', 'Section Updated');
    }

    public function destroy(Faq $section)
    {
        $section->delete();
        return back()->with('success', 'Section Deleted');
    }
}
