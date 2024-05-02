<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EligFile extends Model
{
    protected $connection = 'mysql';
    protected $table = 'elig_files';
    protected $guarded = array();
}
