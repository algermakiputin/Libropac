<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\librarian;

use Illuminate\Support\Facades\Storage;

class LibrarianController extends Controller
{
    public function destroy(Request $request)
    {
        return librarian::where('id', $request->input('id'))->delete();
    }

    public function update(Request $request) {
        if ($request->has('avatar')) {
            $path = $request->file('avatar')->store('/public/avatar');
            $fileName = basename($path);
            Storage::delete('/public/avatar/' .$request->input('old_image'));
            return librarian::where('id', $request->input('id'))->update([
                'image' => $fileName,
                'name' => $request->input('name'),
                'position' => $request->input('position'),
                'description' => $request->input('description'),
                ]);
        }
        
        return librarian::where('id', $request->input('id'))->update([
          
                'name' => $request->input('name'),
                'position' => $request->input('position'),
                'description' => $request->input('description'),
                ]);
        
    }

    public function find(Request $request) {

        $student = librarian::where('id', $request->input('id'))->first();

        echo json_encode($student);
    }

    public function index() {
        return view('dashboard.librarian.index');
    }
    public function add () {
    		return view('dashboard.librarian.add');
    }

    public function data(Request $request) {
     
        $totalData = librarian::count();
        $draw = $request->input('draw');
        $limit = intval($request->input('length'));
        $start = intval($request->input('start'));
        $order = intval($request->input('order.0.column'));
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        $col = $request->input("columns.$order.name");
          
        $librarian = librarian::offset($start)
                            ->limit($limit)
                            ->orderBy($col,$dir) 
                            ->get();
     
        

        $data = [];

        if ($librarian) {

            foreach ($librarian as $librarian) {

                $nestedData = [
                    '<img class="img-fluid" style="width:50px;margin:auto;display:block;" src="'. url('storage/avatar'). '/' . $librarian->image .'">',
                    $librarian->name,
                    $librarian->position,            
                    '<div class="btn-group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item edit" data-id="'.$librarian->id.'" data-toggle="modal" data-target="#answer" >Edit <form method="post" action="'. url('admin/books/edit') . '"><input type="hidden" name="_token" value="'. csrf_token() .'"><input type="hidden" name="id" value="'. $librarian->id .'"></form></a>
                        <a class="dropdown-item delete" data-id="'.$librarian->id.'" href="#" >Delete</a>
                        
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

    public function store(Request $request) {

        $request->validate([
                'name' => 'required',
                'description' => 'required',
                'position' => 'required',
                'avatar' => 'required'
            ]);
    	   	$path = $request->file('avatar')->store('/public/avatar');
    	   	$fileName = basename($path);

    	   	librarian::create([
    	   		'name' => $request->input('name'),
    	   		'description' => $request->input('description'),
    	   		'image' => $fileName,
                'position' => $request->input('position')
    	   	]);

    	   	return redirect()->back();
    	   
    }
}
