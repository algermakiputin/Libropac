<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\members;

use App\students;

use App\faculties;

class MembersController extends Controller
{
    public function find(Request $request) {
    		$id = $request->input('id');
 		$type = members::select('type')->where('member_id', $id)->first();
 		$data['type'] = $type;
 		if ($type) {

 			$result = $type->type == "student" ? students::where('member_id', $id)->first() : faculties::where('member_id', $id)->first();


 			if ($result) {
 				$data['data'] = $result;
 				echo json_encode($data);
 			}

 		}
    }
}
