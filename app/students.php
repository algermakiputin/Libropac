<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class students extends Model
{   

    protected $fillable = ['member_id', 'name','gender','course','address','contact','year'];
    
    public function store($request) {

    		return $this->create([
    				'member_id' => $request['member_id'],
    				'name' => $request['name'],
                    
    				'gender' => $request['gender'],
    				'course' => $request['course'],
    				'address' => $request['address'],
    				'contact' => $request['contact'],
                    'year' => $request['year'], 
    			]);
    		
    }
}
