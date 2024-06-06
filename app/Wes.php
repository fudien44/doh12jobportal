<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wes extends Model
{
    protected $connection = 'mysql';
    protected $table = 'wes';
    protected $guarded = array();
}
