<?php

namespace App\Http\Controllers;

use App\Address;
use App\General;
use App\Lending;
use App\Package;
use App\Transaction;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LendingController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth','ckstatus']);
    }

    public function packages()
    {
    	$packages = Package::where('status', 1)->get();
    	$wallets = Address::where('user_id', Auth::id())->get();
    	return view('user.lending.packages', compact('packages','wallets'));
    }

    public function lendingConfirm(Request $request)
    {
		 $this->validate($request,
	      [
	          'package' => 'required',
	          'amount' => 'required',
	          'wallet' => 'required'
	      ]);

  		if ($request->amount<=0) 
  		{
  			return back()->with('alert','Invalid Amount');
  		}
  		else
  		{	
  			$package = Package::find($request->package);

  			if (is_null($package)) 
  			{
  				return back()->with('alert','Select a Package');
  			}
  			else
  			{	
  				$wallet= Address::where('user_id', Auth::id())->where('id', $request->wallet)->first();

  				if (is_null($wallet)) 
  				{
  					return back()->with('alert','Select Your Wallet');
  				}
  				else
  				{
  					if ($wallet->balance<$request->amount) 
  					{
  						return back()->with('alert','Insufficient Balance');
  					}
  					else
  					{	
  						$wallet['balance'] = $wallet->balance - $request->amount;
  						$wallet->save();

              $gnl = General::first();

	  					$trans['receiver'] = $gnl->wprefix.'00000000000000000000000000000000';
	    				$trans['rcid'] = 0;
	    				$trans['sender'] = $wallet->address;
	    				$trans['snid'] = $wallet->user_id;
	    				$trans['amount'] = $request->amount;
	    				$trans['trxid'] = str_random(32);
	    				Transaction::create($trans);

						$invest['user_id'] =Auth::id();
						$invest['address_id'] =$wallet->id;
            $invest['package_id'] =$package->id;
            $invest['amount'] = $request->amount;
            $invest['rtime'] = '0';
            $invest['returned'] = '0';
            $invest['next'] = Carbon::parse()->addHours($package->period);
            $invest['status'] = 1;
            Lending::create($invest);

  						return back()->with('success','Lending Successfull');
  					}
  				}
  			}
  		}
    }

    public function log()
    {
    	$logs = Lending::where('user_id', Auth::id())->paginate(20);
    	return view('user.lending.logs', compact('logs'));
    }
}
