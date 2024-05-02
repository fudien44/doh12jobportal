<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherFile extends Model
{
    protected $connection = 'mysql';
    protected $table = 'other_files';
    protected $guarded = array();
}
