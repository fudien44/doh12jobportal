<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PsipopModel extends Model
{
    //
        protected $connection = 'mysql_hris';
    protected $table = 'psipop';
    protected $guarded = array();

    public function position()
    {
        return $this->belongsTo(ApiPosition::class, 'position_id', 'id');
    }

    public function salgrade()
    {
        return $this->belongsTo(ApiSalGrade::class, 'sg_id', 'id');
    }
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }
}
