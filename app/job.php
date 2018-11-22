<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class job extends Model
{
    //
    protected $primaryKey = 'jID';
    protected $fillable = ['company'];
    public function applicant()
    {
        return $this->belongsToMany('App\Applicant', 'applications', 'apID', 'jID', 'aID');
    }

}
