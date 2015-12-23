<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';

    protected $guarded = ['id'];

    // protected $fillable = ["emp_id", "datetime", "verified", "status", "workcode", "device_id", "created_at", "updated_at"];

    public $timestamps = true;

    public function scopedeviceLogs($query, $id)
    {
        return $query->where('device_id', $id);
    }

    public function employess()
    {
        return $this->hasMany('App\Employee', 'pin', 'emp_id');
    }
}
