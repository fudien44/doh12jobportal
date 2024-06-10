<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $connection = 'mysql';
    protected $table = 'messages';
    protected $guarded = array();

    public function tp() {
        switch ($this->type_message) {
            case '0':
                return '<small class="badge badge-danger" data-toggle="modal" data-target="#modal-track-app" style="cursor: pointer;" onclick="getAppID('.$this->app_id.')"><i class="far fa-clock"></i>Not Qualified (Based on minimum QS)</small>';
                break;
            case '1':
                return '<small class="badge badge-warning" data-toggle="modal" data-target="#modal-track-app" style="cursor: pointer;" onclick="getAppID('.$this->app_id.')"><i class="far fa-clock"></i>Qualified for exam</small>';
                break;
            case '2':
                return '<small class="badge badge-danger" data-toggle="modal" data-target="#modal-track-app" style="cursor: pointer;" onclick="getAppID('.$this->app_id.')"><i class="far fa-clock"></i>Not Accepted</small>';
                break;
            case '3':
                return '<small class="badge badge-warning" data-toggle="modal" data-target="#modal-track-app" style="cursor: pointer;" onclick="getAppID('.$this->app_id.')"><i class="far fa-clock"></i>For Interview</small>';
                break;
            case '4':
                return '<small class="badge badge-success" data-toggle="modal" data-target="#modal-track-app" style="cursor: pointer;" onclick="getAppID('.$this->app_id.')"><i class="far fa-clock"></i>Accepted</small>';
                break;
            case '5':
                return '<small class="badge badge-danger" data-toggle="modal" data-target="#modal-track-app" style="cursor: pointer;" onclick="getAppID('.$this->app_id.')"><i class="far fa-clock"></i>Missing Requirements</small>';
                break;
            default:
                return '<small class="badge badge-danger"><i class="far fa-clock"></i> In review</small>';
                break;
        }
    }

}
