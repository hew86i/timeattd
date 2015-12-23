<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = ['pin', 'name', 'device_id', 'password', 'group', 'privilege', 'card', 'pin2', 'tz1', 'tz2', 'tz3'];

    public $timestamps = true;

    public function scopeEmp($query, $pin)
    {
        return $query->where('pin', $pin);
    }

    public function logs()
    {
        return $this->hasMany('App\Log', 'emp_id', 'pin');
    }
}
