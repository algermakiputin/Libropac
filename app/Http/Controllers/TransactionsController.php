<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\students;
use App\transactions;
use App\members;
use App\faculties;
use App\books;
use App\medias;
use Carbon\Carbon;
use Session;

class TransactionsController extends Controller
{

    public function index() {

        return view('dashboard.transactions.index');

    }

    public function member() {

        $d = Carbon::now();
        $date = ($d->setTimeZone('Asia/Manila')->format('m-d-Y g:i a'));
        $nextTransactionId = DB::table('transactions')->max('id') + 1; 

        $transaction_id = sprintf("%05d", $nextTransactionId); 
        return view('dashboard.transactions.member',compact('date', 'transaction_id'));
    }


    public function returnUpdate(Request $request) {

        $request->validate([    
                'transaction_id' => 'required'
            ]);
    

        $transaction = transactions::find($request->input("transaction_id"));
     
        if ($transaction) {
            $type = $transaction->type;

            if ($transaction->type == 'media') 
                $id = $transaction->media_id;
            else 
                $id = $transaction->book_id;

            $setAvailable = $type == "media" ? medias::where('id', $id)->update(['status' => 1]) : books::where('id', $id)->update(['status' => 1]);
      
            transactions::where('id', $transaction->id)->update(['status' => 'completed']);
               
        }

    }

    public function lostUpdate(Request $request) { 
        $request->validate([
                'transaction_id' => 'required'
            ]);

        $process = transactions::where([
                'transaction_id' => $request->input('transaction_id'),
                'status' => 'pending'
            ])->count();

        if ($process) {
             (new transactions)->where('transaction_id', $request->transaction_id)->update(['status' => 'lost']);
             return 1;
          
        }
            
        return 0;
    }

    public function data(Request $request) {

        $totalData = transactions::count();
        $draw = $request->input('draw');
        $limit = intval($request->input('length'));
        $start = intval($request->input('start'));
        $order = intval($request->input('order.0.column'));
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        $col = $request->input("columns.$order.name");
        $status = $request->input('columns.6.search.value');
        
        if ($search == "" && $status == "") {
            $transactions = transactions::offset($start)
            ->limit($limit)
            ->orderBy($col,$dir)
            ->get();
        }else if ($status !== "" && $search == "") {
            $transactions = transactions::offset($start)
            ->limit($limit)
            ->orderBy($col,$dir)
            ->where('status', $status)
            ->get();
        }else if ($search !== "" ) {
            $transactions = DB::table('transactions')->offset($start)
                ->limit($limit)
                ->orderBy($col,$dir)
                ->leftJoin('students','students.member_id', '=', 'transactions.member_id')
                ->leftJoin('faculties','faculties.member_id', '=', 'transactions.member_id')
                ->where('students.name', 'like', '%' . $search . '%')
                ->orWhere('faculties.name', 'like', '%' . $search . '%')
                ->orWhere('transactions.status', '=', $status)
                ->select('transactions.*')
                ->get();
        }
 
        $data = [];

        if ($transactions) {

            $format = "m-d-y, g:i a";
            foreach ($transactions as $transaction) {
             
                $loaning_period = $this->formatLoaningPeriod($transaction->loaning_period, $transaction->created_at);
                
                $name = $this->getMemberName($transaction->member_type,$transaction->member_id);

                $title = $this->getTitle($transaction->type, $transaction->book_id, $transaction->media_id);
                
                $DeferenceInHumans = Carbon::parse($transaction->created_at)->diffForHumans();
                $diffInDays = Carbon::parse($transaction->created_at)->diffInDays($transaction->updated_at);
                $diffInHours = Carbon::parse($transaction->created_at)->diffInHours($transaction->updated_at);
                $penalty = Carbon::parse($transaction->loaning_period);
                $status = $transaction->status;
                $action = $transaction->status !== "completed" ? '<a class="dropdown-item return" href="#" data-id="'. $transaction->id .'">Return</a>' : '';
                $nestedData = [
                    $transaction->transaction_id,
                    $transaction->transaction_id,
                    Carbon::parse($transaction->created_at)->format($format),                
                    $name,
                    $transaction->member_type,
                    $transaction->type,
                    $title,
                    ucfirst($transaction->status), 
                    '<div class="dropdown">
                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        '. $action .'
                        <a class="dropdown-item lost" href="#" data-id="'. $transaction->id .'">Lost Resource</a> 
                      </div>
                    </div>',
                    $status == 'completed' ? Carbon::parse($transaction->updated_at)->format($format) : ($status == "pending" ? 'Pending' : '--'),
                    $loaning_period,
                    $status == "pending" ? $DeferenceInHumans : ($status == "lost" ? '--' : ($diffInDays > 1 ? $diffInDays . 'Days' : $diffInDays  . ' Day ') . ' : '.( $diffInHours > 1 ? $diffInHours % 24 . ' Hours' : $diffInHours  % 24 . ' Hour')),
                    $penalty->format('m-d-y, g:i a'),
                    $this->getPenaltyHours($status, $penalty, $transaction->updated_at) 
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

    public function getPenaltyHours ($status, $penalty, $updated_at) {
        $now = Carbon::now();
        $updated = Carbon::parse($updated_at);
      
         
        if ($status == "pending") {

            if ($now->gt($penalty)) {

                return $now->diffInHours($penalty) . ' Hours';

            }
            
            return "--";

        } else if ($status == "completed") {

            if ($penalty->lt($updated)) {

                return $penalty->diffInHours($updated) . ' Hours';

            }
            
            return "--";
        }

        return "Charge/Replace";

    }
    public function getTitle($type,$b_id = null,$m_id = null) {

        if ($type == "book")
            return books::select('title')->where('id',$b_id)->first()->title; 
        
        return medias::select('title')->where('id',$m_id)->first()->title;
    }

    public function getMemberName($m_type,$m_id) {
        
        if ($m_type == "student")
            return students::select('name')->where('member_id',$m_id)->first()->name;
        
        return faculties::select('name')->where('member_id',$m_id)->first()->name;
    }

    public function formatLoaningPeriod($loaning_period,$created_at) {

        $period = Carbon::parse($loaning_period);
        $start = Carbon::parse($created_at);

        $hour = ($period->diffInHours($start));

        if ($hour < 24) {
            $loaning_period_hours = Carbon::parse($loaning_period)->diffInHours($start);
            return $loaning_period_hours = $loaning_period_hours . ($loaning_period_hours > 1 ? ' Hours' : ' Hour');
        }else if ($hour < 150) {
            $loaning_period_days = Carbon::parse($loaning_period)->diffInDays($start);
            return $loaning_period_days = $loaning_period_days . ($loaning_period_days > 1 ? ' Days' : ' Day');
        }

        $loaning_period_week = Carbon::parse($loaning_period)->diffInWeeks($start);

        return $loaning_period_week = $loaning_period_week . ($loaning_period_week > 1 ? ' Weeks' : ' Week');
        
    }


    public function new() {

            $d = Carbon::now();
            $date = ($d->setTimeZone('Asia/Manila')->format('m-d-Y g:i a'));
    		$nextTransactionId = DB::table('transactions')->max('id') + 1;
    		$nextUserID = DB::table('members')->max('id') + 1;

    		$transaction_id = sprintf("%05d", $nextTransactionId);
    		$member_id = sprintf("%05d", $nextUserID);
 	 
    		 
    		return view('dashboard.transactions.new',compact('date','transaction_id','member_id'));
    }

    public function insert(Request $request) { 
        
            DB::transaction(function() use($request) {
                $due = Carbon::now();
                $due->addHour((int)$request->input('loaning_period'));

                $transaction_id = $request->input('transaction_id');
                $membership_type = $request->input('membership_type');
                $member_id = $request->input('member_id');
                $book_id = $request->input('book_id');
                $media_id = $request->input('media_id');
                $type = $request->input('barrow');
           

                $students = new students;
                $faculties = new faculties;
                $members = new members;
                $transactions = new transactions;

                if ($request->input('member')) {

                    $transactions->store($transaction_id, $member_id, $book_id, $type, $media_id, $due,$membership_type);
                    $type == "book" ? books::where('id',$book_id)->update(['status' => 0]) : medias::where('id',$media_id)->update(['status' => 0]) ;
                    Session::flash('success', "Barrow Successfully");
                    return redirect()->back();
                }
                
                $members->store($membership_type, $member_id);

                $membership_type == "student" ? $students->store($request->all()) : $faculties->store($request->all());

                $transactions->store($transaction_id, $member_id, $book_id, $type, $media_id, $due,$membership_type);

                $type == "book" ? books::where('id',$book_id)->update(['status' => 0]) : medias::where('id',$media_id)->update(['status' => 0]) ;

                
            });
    	       Session::flash('success', "Barrow Successfully");
    		return redirect()->back();	
    		
    }
}
