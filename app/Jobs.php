<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
	protected $connection = 'mysql';
    protected $table = 'jobs';
    protected $guarded = array();
    public function sg() {
        return $this->hasOne(SalGrade::class, 'id', 'salary_grade');
    }
    public function typejob() {
        switch ($this->type_job) {
            case '0':
                return 'Full-Time';
                break;
            case '1':
                return 'Part-Time';
                break;
            case '2':
                return 'On-Call';
                break;
            default:
                return 'OTHERS';
                break;
        }
    }
    public function term() {
        switch ($this->term_emp) {
            case '0':
                return 'PS-Contractual';
                break;
            case '1':
                return 'Contract of Service/ Job Order';
                break;
            case '2':
                return 'Plantilla/Permanent';
                break;
            default:
                return 'OTHERS';
                break;
        }
    }
    public function stat() {
        switch ($this->status) {
            case '0':
                return 'Open';
                break;
            case '1':
                return 'Closed';
                break;
            case '2':
                return 'Re-opened';
                break;
            case '3':
                return 'Screening';
                break;
            default:
                return 'OTHERS';
                break;
        }
    }
    public function applicants() {
        return $this->hasMany(Application::class, 'job_id', 'id')
        ->with('applicant')
        ->join('users','users.id','=','applications.user_id')
        ->orderBy('users.lname','asc');
    }
    public function notq() {
        return $this->hasMany(Application::class, 'job_id', 'id')
        ->with('applicant')
        ->with('latst')
        ->join('users','users.id','=','applications.user_id')
        ->join('messages','messages.app_id','=','applications.id')
        ->where('messages.type_message','!=', '2')
        ->orderBy('users.lname','asc');
    }
}
