<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\students;

class transactions extends Model
{
	protected $fillable = ['type','transaction_id', 'member_id','book_id','media_id','loaning_period','status','member_type'];

    	public function store($transaction_id, $member_id, $book_id,$type, $media_id, $loaning_period,$member_type) {

    		return $this->create([
    			'transaction_id' => $transaction_id, 
    			'member_id' => $member_id, 
    			'book_id' => $book_id,
    			'status' => 'pending',
    			'type' => $type,
                'media_id' => $media_id,
                'loaning_period' => $loaning_period,
                'member_type' => $member_type

    			]);

    	}
}
