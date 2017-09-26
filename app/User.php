<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['firstName', 'lastName', 'email', 'isAdmin'];
    protected $primaryKey = 'email';
    public $incrementing = false;

    public function tickets()
    {
        return $this->hasMany('Ticket');
    }

}
