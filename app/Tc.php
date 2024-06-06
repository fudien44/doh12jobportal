<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tc extends Model
{
    protected $connection = 'mysql';
    protected $table = 'tcs';
    protected $guarded = array();
}
