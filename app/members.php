<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class members extends Model
{
    protected $fillable = ['type', 'member_id'];

    	public function store($type, $id) {

    		return $this->create(['type' => $type, 'member_id' => $id]);

    	}

    	 
}
