<?php

namespace App\Http\Controllers;

 

use Illuminate\Http\Request;

use App\faqs;

use Session;

use DB;

use Illuminate\Support\HtmlString;

class FaqsController extends Controller
{
    
    public function ask() {
    	return view('faqs.ask');
    }

    public function index() {

        return view('faqs.index');
    }

    public function faqs() {

        $faqs = faqs::select('faqs.*','users.name as u_name')
                ->where('status',1)
                ->leftJoin('users', 'users.id', '=','faqs.answered_by')
                ->orderBy('updated_at','DESC')
                ->paginate(10);
 
        return view('faqs.faqs',compact(('faqs')));
    }

    public function faqsPaginate(Request $request) {
        $data = faqs::select('users.name as u_name','faqs.*')
                ->where('status',1)
                ->leftJoin('users', 'users.id', '=','faqs.answered_by')
                ->orderBy('updated_at','DESC')->paginate(10);

        $links = ($data->links());
        $dataSet = [];
        foreach ($data as $data) {
            $dataSet[] = [
                'id' => $data->id,
                'question' => $data->question,
                'answer' => preg_replace("/\n/", "<br />", $data->answer),  
                'updated_at' => date('F jS, Y', strtotime($data->updated_at)),
                'u_name' => ucwords($data->u_name)
            ];
        }


        if ($request->ajax())
        {
         $res = array(
          'data' => $dataSet,
          'links' => htmlentities($links)    
               );
         echo json_encode($res);
        }
        
    }


    public function answer(Request $request, faqs $faq) {
        
        if ($faq->answer($request->all())) {
            return 1;
        }

        return 0;
    }

    public function destroy(Request $request) {

        return faqs::where('id', $request->input('id'))->delete();
    }

    public function find(Request $request) {
        
        echo json_encode(faqs::find($request->input('id')));
    }

    public function approve(Request $request, faqs $faq) {
        if ($faq->approve($request->all())) {
            echo "test";
        }
    }

    public function disapprove(Request $request, faqs $faq) {
        if ($faq->disapprove($request->all())) {
            echo "test";
        }
    }

    public function store(Request $request) {

        $request->validate([
                'name' => 'required',
                'question' => 'required',
                'details' => 'required',
            ]);
    		$save = faqs::insert([
    			'name' => $request->input('name'),
    			'question' => $request->input('question'),
    			'details' => $request->input('details'),
    			'status' => 0
    			]);

    		if ($save) 
                return 1;

            return 0;
    }

    public function data(Request $request) {
        $totalData = faqs::count();

        $limit = intval($request->input('length'));
        $start = intval($request->input('start'));
        $order = intval($request->input('order.0.column'));
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        $col = $request->input("columns.$order.name");
        
        if ($search == "") {
             $faqs = faqs::offset($start)
            ->limit($limit)
            ->orderBy($col,$dir)
            ->get();
        }else {
            $faqs = faqs::offset($start)
            ->limit($limit)
            ->orderBy($col,$dir)
            ->where('name','LIKE', '%' . $search . '%')
            ->get();
        }
        

        $data = [];

        if ($faqs) {

            foreach ($faqs as $faq) {
                $approve = $faq->status ? '<a class="dropdown-item disapprove" data-id="'.$faq->id.'" href="#" >Disapprove</a>' : '<a class="dropdown-item approve" data-id="'.$faq->id.'" href="#" >Approve</a>';
                $nestedData = [
                    $faq->name,
                    $faq->question,
                    $faq->details,
                    $faq->status ? 'Approved' : 'Pending',
                    '<div class="btn-group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item answer" data-id="'.$faq->id.'" data-toggle="modal" data-target="#answer" >Answer Question</a>
                        '. $approve .'
                        <a class="dropdown-item delete" data-id="'.$faq->id.'" href="#" >Delete</a>
                       
                      </div>
                    </div> '

                ];

                $data[] = $nestedData;
            }

            $json_data = array(
                'draw' => $request->input('draw'),
                'recordsTotal' => intval($totalData),
                'recordsFiltered' => $totalData,
                'data' => $data,
                'paging' => 'false'
                );

            echo json_encode($json_data);
        }
    }
}
