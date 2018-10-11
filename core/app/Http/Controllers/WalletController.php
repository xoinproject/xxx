<?php

namespace App\Http\Controllers;

use App\Address;
use App\Gateway;
use App\General;
use App\Price;
use App\Sell;
use App\Transaction;
use App\User;
use Auth;
use Session;
use Illuminate\Http\Request;

class WalletController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth','ckstatus']);
    }

    public function transactions()
    {
      $trans = Transaction::where('rcid',Auth::id())->orWhere('snid', Auth::id())->paginate(20);
      return view('user.transactions', compact('trans'));
    }

    public function createAddress(Request $request)
    {
    	if (is_null($request->label)) 
    	{
    		$label = 'No Label';
    	}
    	else
    	{
    		$label = $request->label;
    	}

      $gnl = General::first();
    	$wallet['user_id'] = Auth::id();
    	$wallet['label'] = $label;
    	$wallet['address'] = $gnl->wprefix.str_random(12);
    	$wallet['balance'] = '0';
    	Address::create($wallet);

    	return back()->with('success','New Wallet Address Created Successfully');
    }

    public function allWallets()
    {
        $wallets = Address::where('user_id', Auth::id())->orderBy('id','DESC')->paginate(20);
        return view('user.allwallets', compact('wallets'));
    }

    public function sendMoney(Request $request)
    {
    	$this->validate($request,
            [
                'amount' => 'required',
                'fromad' => 'required',
                'toadd' => 'required',
            ]);
        $gnl = General::first();
    	$uwallet = Address::find($request->fromad);
        $toadds = explode('?', $request->toadd);

    	$towallet = Address::where('address',$toadds[0])->first();

    	if(is_null($uwallet) || is_null($towallet)) 
    	{
          return back()->with('alert', 'Invalid Wallet Address');
    	}
    	else
    	{
    		if ($request->amount<0) 
    		{
          		return back()->with('alert', 'Invalid Amount');
    		}
    		else
    		{
    			if ($uwallet->balance<$request->amount) 
    			{
    				return back()->with('alert', 'Insufficient Balance');
    			}
    			else
    			{
    				$total = $request->amount+($request->amount*$gnl->trancrg)/100;

    				$uwallet['balance'] = $uwallet->balance-$total;
    				$uwallet->save();

    				$towallet['balance'] = $towallet->balance+$request->amount;
    				$towallet->save();

    				$trans['receiver'] = $towallet->address;
    				$trans['rcid'] = $towallet->user_id;
    				$trans['sender'] = $uwallet->address;
    				$trans['snid'] = $uwallet->user_id;
    				$trans['amount'] = $request->amount;
    				$trans['trxid'] = str_random(32);
    				Transaction::create($trans);

    				return back()->with('success', $gnl->cur.' Sent Successfully');
    			}
    		}
    	}
    }

    public function receiveMoney(Request $request)
    {

      $valid = Address::find($request->toacc);
     
      if (is_null($valid) || $valid->user_id != Auth::id() ) 
      {
        return back()->with('alert', 'This is Not Your Wallet Address');
      }
      else
      {
        $gnl= General::first();
         $varb = $valid->address."?amount=".$request->coinamount;
         $bcode['code'] = $varb;
         $bcode['qcode'] =  "<img src=\"https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$varb&choe=UTF-8\" title='' style='width:300px;' />";
        
        return $bcode; 
      }
   }

   public function purchaseGateway()
   {
        $gates = Gateway::where('status', 1)->get();
        $gnl = General::first();
        $sold = Address::sum('balance');
        $avail = $gnl->stock - $sold;
        return view('user.purchase', compact('gates','avail'));
   }

   public function purchasePreview(Request $request)
    {
      $this->validate($request,
            [
                'amount' => 'required',
                'gateway' => 'required',
            ]);

         $gnl = General::first();
         $sold = Address::sum('balance');
         $avail = $gnl->stock - $sold;

         if ($request->amount <=0 || $request->amount > $avail) 
         {
            return back()->with('alert', 'Invalid Amount');
         }
         else
         {
            $gate = Gateway::findOrFail($request->gateway);
            if(is_null($gate))
            {
              return back()->with('alert', 'Please Select a Payment Gateway');
            }
            else
            {
                $price = Price::latest()->first();

              if ($gate->id == 3 || $gate->id == 6 || $gate->id == 7 || $gate->id == 8) 
              {
                  $all = file_get_contents("https://blockchain.info/ticker");
                  $res = json_decode($all);
                  $btcrate = $res->USD->last;

                  $amount = $request->amount;
                  $usd = $price->price*$amount;
                  $btcamount = $usd/$btcrate;
                  $btc = round($btcamount, 8);

                  $sell['user_id'] = Auth::id();
                  $sell['ico_id'] = 0;
                  $sell['gateway_id'] = $gate->id;
                  $sell['amount'] = $amount;
                  $sell['status'] = 0;
                  $sell['trx'] = str_random(16);
                  Sell::create($sell);
                  Session::put('Track', $sell['trx']);

                  return view('user.purpreview', compact('btc','gate','amount'));
              }
              else
              {
                  $amount = $request->amount;
                  $usd = $price->price*$amount;

                  $sell['user_id'] = Auth::id();
                  $sell['ico_id'] =0;
                  $sell['gateway_id'] = $gate->id;
                  $sell['amount'] = $amount;
                  $sell['status'] = 0;
                  $sell['trx'] = str_random(16);
                  Sell::create($sell);
                  Session::put('Track', $sell['trx']);

                  return view('user.purpreview', compact('usd','gate','amount'));
              }
            }
          }
    }      

}
