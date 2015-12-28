<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connected extends Model
{
    protected $table = 'connected';

    protected $fillable = ['ip_address', 'device_id', 'connected'];

    public $timestamps = true;
}
