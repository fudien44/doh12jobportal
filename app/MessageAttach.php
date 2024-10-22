<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageAttach extends Model
{
    protected $connection = 'mysql';
    protected $table = 'message_attaches';
    protected $guarded = array();
}
