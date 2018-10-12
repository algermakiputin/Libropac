<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\medias;

use DB;

class MediaController extends Controller
{

    public function opac() {
        return view('media.index');
    }

    public function index(){
        
        return view('dashboard.medias.index');
    }

    public function add() {

        $id = DB::table('medias')->max('id') + 1;
        
        do {
            $rand = rand(1,1000) + $id;
            $accession_num = sprintf('%06d', $rand);
        }while($this->accession_number_exist($accession_num));
      
    	return view('dashboard.medias.add',compact('accession_num'));
    }

    public function insert(Request $request) {
            $request->validate([
                'accession_number' => 'required',
                'title' => 'required',
                'author' => 'required',
                'publisher' => 'required',
                'copyright' => 'required',
                'type' => 'required',
                'subjectTerm1' => 'required',
                'subjectTerm2' => 'required',
                'degree_program' => 'required',
                'subject_code' => 'required',
                'source_fund' => 'required',
                'encoded' => 'required',
                'price' => 'required', 
                ]);
    		(new medias)->store($request->all());

    		return redirect()->back();
    }

    function accession_number_exist($accession_num) {
        if (medias::where('accession_number', '=', $accession_num)->count() > 0) {
          return true;
        }

        return false;
    }

    public function edit(Request $request) {
        $media = medias::find($request->input('id'));

        return view('dashboard.medias.edit',compact('media'));
    } 

    public function update(Request $request) {

        if ((new medias)->modify($request->all())) 
            return redirect('admin/media');
    }

    public function destroy(Request $request) {

        if ((new medias)->where('id',$request->input('id'))->delete()) 
            return 1;

        return 0;
    }

    public function selectData(Request $request) {
         
        $totalData = medias::count();
        $draw = $request->input('draw');
        $limit = intval($request->input('length'));
        $start = intval($request->input('start'));
        $order = intval($request->input('order.0.column'));
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        $col = $request->input("columns.$order.name");
        $degree_program = $search == "" ? $request->input("columns.1.search.value") : '';

        if ($search == "" && $degree_program == "") {
            $medias = medias::offset($start)
            ->limit($limit)
            ->orderBy($col,$dir)
            ->get();
        }
        else if (!$search == "" && $degree_program == "") {
             $medias = medias::offset($start)
            ->limit($limit)
            ->orderBy($col,$dir)
            ->where('title','LIKE', '%' . $search . '%')
            ->orWhere('author1', 'LIKE', '%' . $search . '%')
            ->get();
        }else if ($degree_program !== "") {
            $medias = medias::offset($start)
            ->limit($limit)
            ->orderBy($col,$dir)
            ->where('degree_program', $degree_program)
            ->get();
        } 
        

        $data = [];

        if ($medias) {

            foreach ($medias as $media) {

                $nestedData = [
                $media->id,
                $media->title ? $media->title : 'N/A',                
                $media->author ? $media->author : 'N/A',
                $media->type ? $media->type : 'N/A',
                $media->accession_number,

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

    public function adminData(Request $request) {
         
        $totalData = medias::count();
        $draw = $request->input('draw');
        $limit = intval($request->input('length'));
        $start = intval($request->input('start'));
        $order = intval($request->input('order.0.column'));
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        $col = $request->input("columns.$order.name");
        $degree_program = $search == "" ? $request->input("columns.1.search.value") : '';

        if ($search == "" && $degree_program == "") {
            $medias = medias::offset($start)
            ->limit($limit)
            ->orderBy($col,$dir)
            ->get();
        }
        else if (!$search == "" && $degree_program == "") {
             $medias = medias::offset($start)
            ->limit($limit)
            ->orderBy($col,$dir)
            ->where('title','LIKE', '%' . $search . '%')
            ->orWhere('author', 'LIKE', '%' . $search . '%')
            ->get();
        }else if ($degree_program !== "") {
            $medias = medias::offset($start)
            ->limit($limit)
            ->orderBy($col,$dir)
            ->where('degree_program', $degree_program)
            ->get();
        } 
        

        $data = [];

        if ($medias) {

            foreach ($medias as $media) {

                $nestedData = [
                $media->accession_number ? $media->accession_number : 'N/A',
                $media->title ? $media->title : 'N/A',                
                $media->author ? $media->author : 'N/A',
                $media->type ? $media->type : 'N/A',
                $media->source_fund  ? $media->source_fund : 'N/A',
                $media->price  ? $media->price : 'N/A',
                $media->status ? 'Available' : 'Checkout',
                '<div class="btn-group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item edit" data-id="'.$media->id.'" data-toggle="modal" data-target="#answer" >Edit <form method="post" action="'. url('admin/media/edit') . '"><input type="hidden" name="_token" value="'. csrf_token() .'"><input type="hidden" name="id" value="'. $media->id .'"></form></a>
                        <a class="dropdown-item delete" data-id="'.$media->id.'" href="#" >Delete</a>
                        
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

    public function publicData(Request $request) {
        $totalData = medias::count();
        $draw = $request->input('draw');
        $limit = intval($request->input('length'));
        $start = intval($request->input('start'));
        $order = intval($request->input('order.0.column'));
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        $col = $request->input("columns.$order.name");
        $degree_program = $search == "" ? $request->input("columns.3.search.value") : '';

        if ($search == "" && $degree_program == "") {
            $medias = medias::offset($start)
            ->limit($limit)
            ->orderBy($col,$dir)
            ->get();
        }
        else if (!$search == "" && $degree_program == "") {
             $medias = medias::offset($start)
            ->limit($limit)
            ->orderBy($col,$dir)
            ->where('title','LIKE', '%' . $search . '%')
            ->orWhere('author', 'LIKE', '%' . $search . '%')
            ->get();
        }else if ($degree_program !== "") {
            $medias = medias::offset($start)
            ->limit($limit)
            ->orderBy($col,$dir)
            ->where('degree_program', $degree_program)
            ->get();
        } 
        

        $data = [];

        if ($medias) {

            foreach ($medias as $media) {

                $nestedData = [
                $media->accession_number ? $media->accession_number : 'N/A',
                $media->title ? $media->title : 'N/A',                
                $media->author ? $media->author : 'N/A',
                $media->type ? $media->type : 'N/A',
                $media->status ? "Available" : 'Checkout'
                ];

                $data[] = $nestedData;
            }

            $json_data = array(
                'draw' => $draw,
                'recordsTotal' => intval($totalData),
                'recordsFiltered' => $totalData,
                'data' => $data,
                'paging' => 'false',
                'test' => $request->all()
                );

            echo json_encode($json_data);
        }
    }
}
