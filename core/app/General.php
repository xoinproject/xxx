<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    protected $table = 'generals';
    protected $fillable = array( 'title','subtitle', 'color', 'cur','cursym','reg','emailver','smsver','decimal','emailnotf','smsnotf','refcom','ico','transaction','lending','trancrg','stock','wprefix');
}
