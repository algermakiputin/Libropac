<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\transactions;

use DB;

use App\students;

class AnalyticsController extends Controller
{
    public function index() {
    		$year = date('Y');
    		$courses = [];
    		$transactions = DB::table('transactions')
    					->select('transactions.member_id','students.course')
    					->where(DB::raw('DATE_FORMAT(transactions.created_at,"%Y")'), $year)
    					->join('students', 'students.member_id', '=', 'transactions.member_id')
    					->get()->toArray();
    	 	
    	 	foreach ( $transactions as $t ) {
    	 		$courses[$t->course][] = $t;
    	 	}

    	 	$course = json_encode($courses);
    	   
    		return view('dashboard.analytics.index',compact('course'));
    }
}
