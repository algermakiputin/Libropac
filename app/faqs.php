<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class faqs extends Model
{
    
    protected $fillable = ['question','answer','details','name','status'];

    public function answer($request) {

    		return $this->where('id',$request['id'])->update([
    				'answer' => $request['answer'],
                    'answered_by' => Auth()->user()->id 
    			]);
    }

    public function approve($request) {

    		return $this->where('id',$request['id'])->update([
    				'status' => 1
    			]);
    }

    public function disapprove($request) {
    		return $this->where('id',$request['id'])->update([
    				'status' => 0
    			]);
    }

  


}
