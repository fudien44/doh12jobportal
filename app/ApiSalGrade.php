<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiSalGrade extends Model
{
    //

    
     protected $connection = 'mysql_hris';
    protected $table = 'salary_grades';
    protected $guarded = array();


    public function psipop()
    {
        return $this->hasMany(PsipopModel::class, 'sg_id', 'id');
    }
}
