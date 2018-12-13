<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\students;
use App\members;
class StudentsController extends Controller
{
    
    public function index()
    {
        return view('dashboard.students.index');
    }

    public function data(Request $request) {
     
        $totalData = students::count();
        $draw = $request->input('draw');
        $limit = intval($request->input('length'));
        $start = intval($request->input('start'));
        $order = intval($request->input('order.0.column'));
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        $col = $request->input("columns.$order.name");
       
        if ($search !== "") {

            $students = students::offset($start)
            ->limit($limit)
            ->orderBy($col,$dir)
            ->where('name','LIKE', '%' . $search . '%') 
            ->get();
        }else {
            $students = students::offset($start)
            ->limit($limit)
            ->orderBy($col,$dir)
            ->get();
        }
        

        $data = [];

        if ($students) {

            foreach ($students as $student) {

                $nestedData = [
                    $student->member_id,
                    $student->name,                
                    $student->gender,
                    $student->course,
                    $student->year,
                    $student->address,
                    $student->contact,
                    '<div class="btn-group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item edit" data-id="'.$student->id.'" data-toggle="modal" data-target="#answer" >Edit <form method="post" action="'. url('admin/books/edit') . '"><input type="hidden" name="_token" value="'. csrf_token() .'"><input type="hidden" name="id" value="'. $student->id .'"></form></a>
                        <a class="dropdown-item delete" data-id="'.$student->member_id.'" href="#" >Delete</a>
                        
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
        return students::where('id', $request->input('id'))->update([
                'name' => $request->input('name'),
                'gender' => $request->input('gender'),
                'course' => $request->input('course'),
                'year' => $request->input('year'),
                'address' => $request->input('address'),
                'contact' => $request->input('contact'),
            ]);
    }

 
    public function destroy(Request $request)
    {
        members::where('member_id', $request->input('id'))->delete();
        return students::where('member_id', $request->input('id'))->delete();
    }

    public function find(Request $request) {

        $student = students::where('id', $request->input('id'))->first();

        echo json_encode($student);
    }
}
