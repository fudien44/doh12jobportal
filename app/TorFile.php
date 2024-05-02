<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TorFile extends Model
{
    protected $connection = 'mysql';
    protected $table = 'tor_files';
    protected $guarded = array();
}
