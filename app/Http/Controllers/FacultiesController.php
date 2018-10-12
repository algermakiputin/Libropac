<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\faculties;

class FacultiesController extends Controller
{
	public function index()
	{
		return view('dashboard.faculties.index');
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data(Request $request) {
  
    	$totalData = faculties::count();
    	$draw = $request->input('draw');
    	$limit = intval($request->input('length'));
    	$start = intval($request->input('start'));
    	$order = intval($request->input('order.0.column'));
    	$dir = $request->input('order.0.dir');
    	$search = $request->input('search.value');
    	$col = $request->input("columns.$order.name"); 

    	if ($search !== "") {

    		$faculties = faculties::offset($start)
            ->limit($limit)
            ->orderBy($col,$dir)
            ->where('name','LIKE', '%' . $search . '%') 
            ->get();
    	}else {
    		$faculties = faculties::offset($start)
	    	->limit($limit)
	    	->orderBy($col,$dir)
	    	->get();
    	}
                 
 
    	$data = [];

    	if ($faculties) {

        		foreach ($faculties as $faculty) {

        			$nestedData = [
        			$faculty->member_id,
        			$faculty->name,                
        			$faculty->gender,
        			$faculty->position, 
        			$faculty->address,
        			$faculty->contact,
        			'<div class="btn-group">
        			<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        				Action
        			</button>
        			<div class="dropdown-menu">
        				<a class="dropdown-item edit" data-id="'.$faculty->id.'" data-toggle="modal" data-target="#answer" >Edit <form method="post" action="'. url('admin/books/edit') . '"><input type="hidden" name="_token" value="'. csrf_token() .'"><input type="hidden" name="id" value="'. $faculty->id .'"></form></a>
        				<a class="dropdown-item delete" data-id="'.$faculty->id.'" href="#" >Delete</a>

        			</div>
        		</div> ' 
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
 
    public function update(Request $request)
    {
    	return faculties::where('id', $request->input('id'))->update([
    		'name' => $request->input('name'),
    		'gender' => $request->input('gender'),
    		'position' => $request->input('position'), 
    		'address' => $request->input('address'),
    		'contact' => $request->input('contact'),
    		]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    	return faculties::where('id', $request->input('id'))->delete();
    }

    public function find(Request $request) {

    	$faculty = faculties::where('id', $request->input('id'))->first();

    	echo json_encode($faculty);
    }
}
