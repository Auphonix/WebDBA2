<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['userEmail','content'];

    public function ticket(){
        return $this->belongsTo('App\Ticket', 'id');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }



}
