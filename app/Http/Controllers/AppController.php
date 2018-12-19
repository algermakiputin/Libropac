<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\news;

use App\notices;

use App\faqs;

use App\settings;

use App\transactions;

use DB;

use App\students;

use App\faculties;

use App\members;

use App\books;

use App\medias;

use App\librarian;

class AppController extends Controller
{
    public function index() { 
    		$notices = notices::orderBy('updated_at','desc')->limit(6)->get();
    		
    		$about = settings::where('name','about')->first();
            $about->content =  preg_replace("/\r\n/", "<br />", $about->content);

            $faqs = faqs::where('status',1)->orderBy('updated_at','DESC')->limit(5)->offset(0)->get();

            $librarians = librarian::all();
    	 
    		return view('index',compact('notices','about','faqs','librarians'));
    }

    public function admin() {
        
          
            $y = Date('Y');
      
            $dataSet = [];
            $students = [];
            $faculties = [];
            $pending = transactions::where('status','pending')->count();
            $lost = transactions::where('status','lost')->count();
            $complete = transactions::where('status','completed')->count();
            $widget = [
            	$members = members::count(),
	          $books = books::count(),
	          $medias = medias::count(),
	          $transactions = transactions::count(),
            ];
            for ($i = 1; $i < 13; $i++) {
                
                array_push($students, $s = transactions::where(DB::raw('DATE_FORMAT(created_at, "%m")'), $i)->where('member_type','student')->where(DB::raw('DATE_FORMAT(created_at, "%Y")'), $y)->count());
                
                array_push($faculties, $f = transactions::where(DB::raw('DATE_FORMAT(created_at, "%m")'), $i)->where('member_type','faculty')->where(DB::raw('DATE_FORMAT(created_at, "%Y")'), $y)->count());
                           
            }   

    		return view('dashboard.index',compact('students','faculties','pending','lost','complete','widget'));
    }
}
