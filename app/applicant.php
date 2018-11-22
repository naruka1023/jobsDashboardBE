<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class applicant extends Model
{
    //
    protected $primaryKey = 'aID';
    public function job(){
        return $this->belongsToMany('App\Job');

    }
}
