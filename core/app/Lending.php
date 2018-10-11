<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    protected $table = 'lendings';
    protected $fillable = array( 'user_id','address_id','package_id', 'amount', 'rtime','returned','next','status');
   
    public function address()
    {
        return $this->belongsTo('App\Address');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function package()
    {
        return $this->belongsTo('App\Package');
    }
}
