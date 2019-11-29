<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class password extends Model
{
    protected $table = 'paswords';
    protected $filliable = ['title', 'password'];
}
