<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class projectLogs extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id', 'desc_task', 'status',
    ];



}

