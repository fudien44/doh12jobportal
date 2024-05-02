<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PdsFile extends Model
{
    protected $connection = 'mysql';
    protected $table = 'pds_files';
    protected $guarded = array();
}
