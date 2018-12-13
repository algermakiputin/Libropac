<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class medias extends Model
{
	protected $fillable = ['accession_number','title','author','publisher','copyright','type','subjectTerm1','subjectTerm2','degree_program','subject_code','source_fund','encoded','price','status'];

	public function store($request) {

    		return $this->create([
    				'accession_number' => $request['accession_number'],
    				'title' => $request['title'],
    				'author' => $request['author'],
    				'publisher' => $request['publisher'],
    				'copyright' => $request['copyright'],
    				'type' => $request['type'],
    				'subjectTerm1' => $request['subjectTerm1'],
    				'subjectTerm2' => $request['subjectTerm2'],
    				'degree_program' => $request['degree_program'],
    				'subject_code' => $request['subject_code'],
    				'source_fund' => $request['source_fund'],
    				'encoded' => $request['encoded'],
    				'price' => $request['price'],
                    'status' => 1
    			]);
    }

    public function modify($request) {

            return $this->where('id', $request['id'])->update([
                    'accession_number' => $request['accession_number'],
                    'title' => $request['title'],
                    'author' => $request['author'],
                    'publisher' => $request['publisher'],
                    'copyright' => $request['copyright'],
                    'type' => $request['type'],
                    'subjectTerm1' => $request['subject_term1'],
                    'subjectTerm2' => $request['subject_term2'],
                    'degree_program' => $request['degree_program'],
                    'subject_code' => $request['subject_code'],
                    'source_fund' => $request['source_fund'],
                    'encoded' => $request['encoded'],
                    'price' => $request['price'] 
                ]);
    }
}
