<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\user;

use DB;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{
    public function index()
    {

        return view('dashboard.users.index');
    }

    public function store(Request $request) { 
        
            $path = $request->file('avatar')->store('/public/avatar');
            $fileName = basename($path);

    		user::create([
    		 	'name' => $request->input('name'),
    		 	'email' => $request->input('email'),
    		 	'password' => Hash::make($request->input('password')),
    		 	'role' => $request->input('role'),
    		 	'avatar' => $fileName
    		 	]);

            $statement = DB::select("show table status like 'users'");
            return $statement[0]->Auto_increment - 1;
             
    }

    public function data(Request $request) {
     
        $totalData = user::count();
        $draw = $request->input('draw');
        $limit = intval($request->input('length'));
        $start = intval($request->input('start'));
        $order = intval($request->input('order.0.column'));
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        $col = $request->input("columns.$order.name");
          
        if ($search !== "") {
            $users = user::offset($start)
            ->limit($limit)
            ->orderBy($col,$dir)
            ->where('name','LIKE', '%' . $search . '%') 
            ->get();
        }else {
            $users = user::offset($start)
            ->limit($limit)
            ->orderBy($col,$dir)
            ->get();
        }
        

        $data = [];

        if ($users) {

            foreach ($users as $user) {

                $nestedData = [
                    $user->name,
                    $user->email,                
                    $user->role, 
                    '<div class="btn-group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item edit" data-id="'.$user->id.'" data-toggle="modal" data-target="#answer" >Edit</a>
                        <a class="dropdown-item delete" data-id="'.$user->id.'" href="#" >Delete</a>
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
    
    public function updateRole(Request $request)
    { 
    	 
		return user::where('id', $request->input('id'))->update([ 
                'role' => $request->input('role') 
            ]);
    		
    }

    public function update(Request $request) {
        $id = $request->input('id');
         
        if ($request->has('avatar')) {

            $path = $request->file('avatar')->store('/public/avatar');
            $fileName = basename($path);

            return user::where('id', $id)->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'avatar' => $fileName
                ]);
            
        }else {

            return user::where('id', $id)->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email')
                ]);
        }
         
        
        
    }

    public function profile(Request $request) {
        $id = $request->input('id');

        $data = user::where('id', $id)->first();

        return view('dashboard.users.profile',compact('data'));
    }

 
    public function destroy(Request $request)
    {
        return user::where('id', $request->input('id'))->delete();
    }

    public function find(Request $request) {

        $student = user::where('id', $request->input('id'))->first();

        echo json_encode($student);
    }
}
