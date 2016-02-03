<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'klien', 'status','progress','developer','created_at','tgl_pesan','tgl_target','desc'
    ];

    public function log(){
        return $this->hasMany('App\projectLogs');
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];
}
