<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\notices;

class NoticesController extends Controller
{
    public function index()
	{
		return view('dashboard.notices.index');
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function new() {

        return view('dashboard.notices.new');
        
    }

    public function store(Request $request) {
        $request->validate([
                'title' => 'required',
                'content' => 'required'
            ]);
        $save = notices::create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
            ]);

        if ($save) {
            return redirect()->back();
        }

        return redirect()->back();
    }

    public function data(Request $request) {
  
    	$totalData = notices::count();
    	$draw = $request->input('draw');
    	$limit = intval($request->input('length'));
    	$start = intval($request->input('start'));
    	$order = intval($request->input('order.0.column'));
    	$dir = $request->input('order.0.dir');
    	$search = $request->input('search.value');
    	$col = $request->input("columns.$order.name"); 

    	if ($search !== "") {

    		$notices = notices::offset($start)
            ->limit($limit)
            ->orderBy($col,$dir)
            ->where('title','LIKE', '%' . $search . '%') 
            ->get();
    	}else {
    		$notices = notices::offset($start)
	    	->limit($limit)
	    	->orderBy($col,$dir)
	    	->get();
    	}
                 
 
    	$data = [];

    	if ($notices) {

        		foreach ($notices as $notices) {

        			$nestedData = [ 
                    date('Y-m-d',strtotime($notices->created_at)),  
        			$notices->title,      
        			 
                    $notices->content, 
        			'<div class="btn-group">
        			<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        				Action
        			</button>
        			<div class="dropdown-menu">
        				<a class="dropdown-item edit" data-id="'.$notices->id.'" data-toggle="modal" data-target="#answer" >Edit <form method="post" action="'. url('admin/books/edit') . '"><input type="hidden" name="_token" value="'. csrf_token() .'"><input type="hidden" name="id" value="'. $notices->id .'"></form></a>
        				<a class="dropdown-item delete" data-id="'.$notices->id.'" href="#" >Delete</a>

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

    		return notices::where('id', $request->input('id'))->update([
	    		'title' => $request->input('title'),
	    		'content' => $request->input('content'), 
	    		]);
    }

    
    public function destroy(Request $request)
    {
    	return notices::where('id', $request->input('id'))->delete();
    }

    public function find(Request $request) {

	    	$notice = notices::where('id', $request->input('id'))->first();

	    	echo json_encode($notice);
    }
}
