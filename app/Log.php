<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected  $table = 'log';
    public $timestamps = false;
    protected $fillable = ['user_id','created_at'];

    public function loggable(){
        return $this->morphTo();
    }
}
