<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiPosition extends Model
{
    //
     protected $connection = 'mysql_hris';
    protected $table = 'positions';
    protected $guarded = array();

    public function psipop()
    {
        return $this->hasMany(PsipopModel::class, 'position_id', 'id');
    }
}
