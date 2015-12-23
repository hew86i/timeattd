<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    // protected $guarded = ['id'];

    protected $fillable = [
        'device_name',
        'ip_address',
        'com_key',
    ];

    public $timestamps = true;
}
