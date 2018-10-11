<?php

namespace App\Providers;

use App\General;
use App\Price;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

       $gnl = General::first();
        if(is_null($gnl))
        {
            $default = [
                'title' => 'THESOFTKING',
                'subtitle' => 'Subtitle',
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
            $gnl = General::first();
        }
        view()->share('gnl',  $gnl);

        $curprice = Price::latest()->first();
        if(is_null($curprice))
        {
            $default = [
                'price' => '0'
            ];
            Price::create($default);
           $curprice = Price::latest()->first();
        }
        $price = $curprice->price;
        view()->share('price',  $price);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
