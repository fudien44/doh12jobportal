<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalGrade extends Model
{
    protected $connection = 'mysql';
    protected $table = 'salary_grades';
    protected $guarded = array();
}
