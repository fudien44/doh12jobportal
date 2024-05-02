<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $connection = 'mysql';
    protected $table = 'applications';
    protected $guarded = array();

    public function job() {
        return $this->hasOne(Jobs::class, 'id', 'job_id');
    }
    public function letters() {
        return $this->hasMany(AppLetter::class, 'app_id', 'id')->orderBy('id','desc');
    }
    public function applicant() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function latst() {
        return $this->hasOne(Message::class, 'app_id', 'id')->latest('id');
    }
    public function msg() {
        return $this->hasMany(Message::class, 'app_id', 'id')->orderBy('id','desc');
    }
}
