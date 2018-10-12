<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class librarian extends Model
{
    protected $fillable = ['name','description','image','position'];
}
