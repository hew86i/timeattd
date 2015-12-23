<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lastlog extends Model
{
    protected $table = 'lastlogs';

    protected $fillable = ['datetime', 'log_id', 'device_id'];
}
