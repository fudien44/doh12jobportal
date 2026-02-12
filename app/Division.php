<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $connection = 'mysql_hris';
    protected $table = 'divisions';
    protected $guarded = array();

    public function jobs() {
        return $this->hasMany(Jobs::class, 'division_id', 'id');
    }
    public function section() {
        return $this->hasMany(Section::class, 'office', 'id');
    }
    public function psipop(){
        return $this->hasMany(PsipopModel::class, 'division_id', 'id');
    }
}
