<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\books;

use DB;
class BooksController extends Controller
{
	public function index() {

		return view('books.index');
	}

	public function adminIndex() {
		return view('dashboard.books.index');
	}

	public function add() {
		$id = DB::table('books')->max('id') + 1;
		
		do {
			$rand = rand(1,1000) + $id;
			$accession_num = sprintf('%06d', $rand);
		}while($this->accession_number_exist($accession_num));
	 	
	  
		
		return view('dashboard.books.add',compact('accession_num'));
	}

	function accession_number_exist($accession_num) {
		if (books::where('accession_number', '=', $accession_num)->count() > 0) {
		  return true;
		}

		return false;
	}

	public function insert(Request $request, books $book) {
		
		$request->validate([
			'accession_number' => 'required',
			'location_symbol' => 'required',
			'classification' => 'required',
			'title' => 'required',
			'author1' => 'required',
			'author2' => 'required',
			'editor' => 'required',
			'edition' => 'required',
			'publication_place' => 'required',
			'publisher' => 'required',
			'copyright' => 'required',
			'physical_description' => 'required',
			'subjectTerm1' => 'required',
			'subjectTerm2' => 'required',
			'degree_program' => 'required',
			'subjectCode_description' => 'required',
			'notes_summary' => 'required',
			'isbn' => 'required',
			'source_fund' => 'required',
			'date_encoded' => 'required',
			'price' => 'required',
			'loaning_period' => 'required',
			'status' => 'required'
	]);
		if ($book->insert($request->all())) {
			return redirect()->back();
		}
	}

	public function update(Request $request) {
		if ((new books)->modify($request->all())) {
			return redirect('admin/books');
		}
	}

	public function edit(Request $request){
		
		$book = books::find($request->input('id'));

		return view('dashboard.books.edit',compact('book'));
	}

	public function destroy(Request $request) {

		if ((new books)->where('id', $request->input('id'))->delete()) 
			return 1;

		return 0;
	
	}

	public function data(Request $request) {
	 
		$totalData = books::count();
		$draw = $request->input('draw');
		$limit = intval($request->input('length'));
		$start = intval($request->input('start'));
		$order = intval($request->input('order.0.column'));
		$dir = $request->input('order.0.dir');
		$search = $request->input('search.value');
		$col = $request->input("columns.$order.name");
		$degree_program = $search == "" ? $request->input("columns.1.search.value") : '';

		if ($degree_program == "" && $search == "") {
			$books = books::offset($start)
			->limit($limit)
			->orderBy($col,$dir)
			->get();
		}else if (!$search == "" && $degree_program == "") {
			 $books = books::offset($start)
			->limit($limit)
			->orderBy($col,$dir)
			->where('title','LIKE', '%' . $search . '%')
			->orWhere('author1', 'LIKE', '%' . $search . '%')
			->get();
		}else if ($degree_program !== "") {
			$books = books::offset($start)
			->limit($limit)
			->orderBy($col,$dir)
			->where('degree_program', $degree_program)
			->get();
		} 
		

		$data = [];

		if ($books) {

			foreach ($books as $book) {

				$nestedData = [
				$book->location_symbol ? $book->location_symbol : 'N/A',
				$book->classification ? $book->classification : 'N/A',                
				$book->title,
				$book->author1 ? $book->author1 : 'N/A',
				$book->subjectCode_description ? $book->subjectCode_description : 'N/A',
				$book->status ? 'Available' : 'Checked Out',
				$book->loaning_period,
				];

				$data[] = $nestedData;
			}

			$json_data = array(
				'draw' => $draw,
				'recordsTotal' => intval($totalData),
				'recordsFiltered' => $totalData,
				'data' => $data,
				'paging' => 'false'
				);

			echo json_encode($json_data);
		}
	}

	public function selectData(Request $request) {
	 
		$totalData = books::count();
		$draw = $request->input('draw');
		$limit = intval($request->input('length'));
		$start = intval($request->input('start'));
		$order = intval($request->input('order.0.column'));
		$dir = $request->input('order.0.dir');
		$search = $request->input('search.value');
		$col = $request->input("columns.$order.name");
		$degree_program = $search == "" ? $request->input("columns.1.search.value") : '';

		if ($degree_program == "" && $search == "") {
			$books = books::offset($start)
			->limit($limit)
			->orderBy($col,$dir)
			->get();
		}else if (!$search == "" && $degree_program == "") {
			 $books = books::offset($start)
			->limit($limit)
			->orderBy($col,$dir)
			->where('title','LIKE', '%' . $search . '%')
			->orWhere('author1', 'LIKE', '%' . $search . '%')
			->get();
		}else if ($degree_program !== "") {
			$books = books::offset($start)
			->limit($limit)
			->orderBy($col,$dir)
			->where('degree_program', $degree_program)
			->get();
		} 
		

		$data = [];

		if ($books) {

			foreach ($books as $book) {

				$nestedData = [
				$book->id,
				$book->classification ? $book->classification : 'N/A',                
				$book->title,
				$book->author1 ? $book->author1 : 'N/A',
				$book->status ? 'Available' : 'Checked Out',
				$book->loaning_period,
				];

				$data[] = $nestedData;
			}

			$json_data = array(
				'draw' => $draw,
				'recordsTotal' => intval($totalData),
				'recordsFiltered' => $totalData,
				'data' => $data,
				'paging' => 'false'
				);

			echo json_encode($json_data);
		}
	}

	public function admin_data(Request $request) {
		 
		$totalData = books::count();
		$draw = $request->input('draw');
		$limit = intval($request->input('length'));
		$start = intval($request->input('start'));
		$order = intval($request->input('order.0.column'));
		$dir = $request->input('order.0.dir');
		$search = $request->input('search.value');
		$col = $request->input("columns.$order.name");
		$degree_program = $search == "" ? $request->input("columns.1.search.value") : '';

		if ($search == "" && $degree_program == "") {
			$books = books::offset($start)
			->limit($limit)
			->orderBy($col,$dir)
			->get();
		}
		else if (!$search == "" && $degree_program == "") {
			 $books = books::offset($start)
			->limit($limit)
			->orderBy($col,$dir)
			->where('title','LIKE', '%' . $search . '%')
			->orWhere('author1', 'LIKE', '%' . $search . '%')
			->get();
		}else if ($degree_program !== "") {
			$books = books::offset($start)
			->limit($limit)
			->orderBy($col,$dir)
			->where('degree_program', $degree_program)
			->get();
		} 
		

		$data = [];

		if ($books) {

			foreach ($books as $book) {

				$nestedData = [
				$book->location_symbol ? $book->location_symbol : 'N/A',
				$book->classification ? $book->classification : 'N/A',                
				$book->title,
				$book->author1 ? $book->author1 : 'N/A',
				$book->subjectCode_description ? $book->subjectCode_description : 'N/A',
				$book->status ? 'Available' : 'Checked Out',
				'<div class="btn-group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item edit" data-id="'.$book->id.'" data-toggle="modal" data-target="#answer" >Edit <form method="get" action="'. url('admin/books/edit') . '"><input type="hidden" name="_token" value="'. csrf_token() .'"><input type="hidden" name="id" value="'. $book->id .'"></form></a>
                        
                        <a class="dropdown-item delete" data-id="'.$book->id.'" href="#" >Delete</a>
                        
                      </div>
                    </div> ',
				];

				$data[] = $nestedData;
			}

			$json_data = array(
				'draw' => $draw,
				'recordsTotal' => intval($totalData),
				'recordsFiltered' => $totalData,
				'data' => $data,
				'paging' => 'false'
				);

			echo json_encode($json_data);
		}
	}
}
