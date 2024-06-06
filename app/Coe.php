<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coe extends Model
{
    protected $connection = 'mysql';
    protected $table = 'coes';
    protected $guarded = array();
}
