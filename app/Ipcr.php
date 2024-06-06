<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ipcr extends Model
{
    protected $connection = 'mysql';
    protected $table = 'ipcrs';
    protected $guarded = array();
}
