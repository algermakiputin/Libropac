<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class books extends Model
{
	protected $fillable = ['accession_number','location_symbol','classification','title','author1','author2','editor','edition','publication_place','publisher','copyright','physical_description','subjectTerm1','subjectTerm2','degree_program','subjectCode_description','notes_summary','isbn','source_fund','date_encoded','price','loaning_period','status'];
	
    public function insert($request) {

    		return $this->create([
    				'accession_number' => $request['accession_number'],
    				'location_symbol' => $request['location_symbol'],
    				'classification' => $request['classification'],
    				'title' => $request['title'],
    				'author1' => $request['author1'],
    				'author2' => $request['author2'],
    				'editor' => $request['editor'],
    				'edition' => $request['edition'],
    				'publication_place' => $request['publication_place'],
    				'publisher' => $request['publisher'],
    				'copyright' => $request['copyright'],
    				'physical_description' => $request['physical_description'],
    				'subjectTerm1' => $request['subject_term1'],
    				'subjectTerm2' => $request['subject_term2'],
    				'degree_program' => $request['degree_program'],
    				'subjectCode_description' => $request['subject_code'],
    				'notes_summary' => $request['summary'],
    				'isbn' => $request['isbn'],
    				'source_fund' => $request['source_fund'],
    				'date_encoded' => $request['date_encoded'],
    				'price' => $request['price'],
    				'loaning_period' => $request['loaning_period'],
    				'status' => $request['status'],
    			]);
    }

    public function modify($request) {

        return $this::where('id', $request['id'])->update([
                'accession_number' => $request['accession_number'],
                'location_symbol' => $request['location_symbol'],
                'classification' => $request['classification'],
                'title' => $request['title'],
                'author1' => $request['author1'],
                'author2' => $request['author2'],
                'editor' => $request['editor'],
                'edition' => $request['edition'],
                'publication_place' => $request['publication_place'],
                'publisher' => $request['publisher'],
                'copyright' => $request['copyright'],
                'physical_description' => $request['physical_description'],
                'subjectTerm1' => $request['subject_term1'],
                'subjectTerm2' => $request['subject_term2'],
                'degree_program' => $request['degree_program'],
                'subjectCode_description' => $request['subject_code'],
                'notes_summary' => $request['summary'],
                'isbn' => $request['isbn'],
                'source_fund' => $request['source_fund'],
                'date_encoded' => $request['date_encoded'],
                'price' => $request['price'],
                'loaning_period' => $request['loaning_period'],
                'status' => $request['status'],
            ]);
    }
}
