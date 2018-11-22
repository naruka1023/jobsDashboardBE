<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    //
    protected $table = 'company';
    protected $primaryKey = 'cID';
    protected $fillable =['companyName'];
}
