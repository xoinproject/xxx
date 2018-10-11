<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';
    protected $fillable = array( 'name','min','max','ret','times','period','status');

    public function lendings()
    {
        return $this->hasMany('App\Lending', 'id', 'package_id');
    }
}
