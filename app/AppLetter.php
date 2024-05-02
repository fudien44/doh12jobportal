<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppLetter extends Model
{
    protected $connection = 'mysql';
    protected $table = 'app_letters';
    protected $guarded = array();
}
