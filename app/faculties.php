<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class faculties extends Model
{

    protected $fillable = ['member_id', 'name','gender','position','address','contact'];
    
    public function store($request) {

		return $this->create([
				'member_id' => $request['member_id'],
				'name' => $request['f_name'],
				'gender' => $request['f_gender'],
				'position' => $request['f_position'],
				'address' => $request['f_address'],
				'contact' => $request['f_contact'],
			]);
    		
    }
}
