<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $connection = 'mysql_hris';
    protected $table = 'sections';
    protected $guarded = array();
}
