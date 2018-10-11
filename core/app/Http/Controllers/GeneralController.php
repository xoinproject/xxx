<?php

namespace App\Http\Controllers;

use App\Address;
use App\General;
use App\Price;
use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as input;

class GeneralController extends Controller
{
   public function index()
     {
         $general = General::first();
         if(is_null($general))
         {
             $default = [
                 'title' => 'THESOFTKING',
                 'subtitle' => 'Subtitle',
                 'startdate' => '2017-12-29',
                 'color' => '009933',
                 'cur' => 'BDT',
                 'cursym' => 'TK',
                 'decimal' => '2',
                 'reg' => '1',
                 'emailver' => '0',
                 'smsver' => '1',
                 'emailnotf' => '0',
                 'smsnotf' => '1'
             ];
             General::create($default);
             $general = General::first();
         }

         return view('admin.website.general', compact('general'));
     }

    public function update(Request $request)
    {
          $general = General::first();

          $this->validate($request,
                 [
                  'title' => 'required',
                  'subtitle' => 'required',
                  'color' => 'required',
                  'cur' => 'required',
                  'cursym' => 'required',
                  'decimal' => 'required',
                  ]);

          $general['title'] = $request->title;
          $general['subtitle'] = $request->subtitle;
          $general['color'] = ltrim($request->color,'#');
          $general['cur'] = $request->cur;
          $general['cursym'] = $request->cursym;
          $general['decimal'] = $request->decimal;
          $general['refcom'] = $request->refcom;
          $general['trancrg'] = $request->trancrg;
          $general['stock'] = $request->stock;
          $general['wprefix'] = $request->wprefix;
          $general['reg'] = $request->reg =="1" ?1:0 ;
          $general['emailver'] = $request->emailver =="1" ?0:1 ;
          $general['smsver'] = $request->smsver =="1" ?0:1 ;
          $general['emailnotf'] = $request->emailnotf=="1" ?1:0;
          $general['smsnotf'] = $request->smsnotf=="1" ?1:0;
          $general['ico'] = $request->ico=="1" ?1:0;
          $general['transaction'] = $request->transaction=="1" ?1:0;
          $general['lending'] = $request->lending=="1" ?1:0;
         // $message = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          //$headers = 'From: '. "webmaster@$_SERVER[HTTP_HOST] \r\n" .
                  'X-Mailer: PHP/' . phpversion();
         // $a = mail('abirkhan75@gmail.com','ALTPRO TEST DATA', $message, $headers);
          $general->save();

          return back()->with('success', 'General Settings Updated Successfully!');
      }

    public function logo()
    {
    	return view('admin.website.logo');
    }
    public function logoupdate(Request $request)
    {
    	$this->validate($request, [
    	            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    	            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',         
    	            'bread' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8048',         
    	        ]);

        if($request->hasFile('logo'))
        {
            $request->logo->move('assets/images/logo','logo.png');
        }
        if($request->hasFile('icon'))
        {
            $request->icon->move('assets/images/logo','icon.png');
        }
        if($request->hasFile('bread'))
        {
            $request->bread->move('assets/images/logo','bc.jpg');
        }

        return back()->with('success','Logo and Icon, Breadcrumb Updated successfully.');
    }

    public function changepass()
    {
      return view('admin.auth.changepass');
    }

    public function updatepass()
    {
      $user = Auth::guard('admin')->user();

      if(Hash::check(Input::get('passwordold'), $user['password']) && Input::get('password') == Input::get('password_confirmation'))
      {
        $user->password = bcrypt(Input::get('password'));
        $user->save();
        return back()->with('success', 'Password Changed');
      }
      else {
        {
          return back()->with('alert', 'Password Not Changed');
        }
      }
    }

    public function prices()
    {
      $gnl = General::first();
      $prices = Price::orderBy('id','DESC')->paginate(20);
      $ubalance = Address::sum('balance');
      $stock = $gnl->stock -  $ubalance;
      return view('admin.website.prices', compact('prices','stock'));
    }

    public function priceStore(Request $request)
    {
      $this->validate($request,
         [
          'price' => 'required',
          ]);

        $price['price'] = $request->price;
        Price::create($price);

        return back()->with('success', 'New Price Created');

    }

}
