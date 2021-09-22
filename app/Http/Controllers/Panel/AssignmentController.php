<?php

namespace App\Http\Controllers\panel;

use App\User;
use Carbon\Carbon;
use App\AssignmentUpload;
use App\Models\Assignment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index($id){
        $today=  date('Y-m-d');
        $assignments = Assignment::whereDate('deadline', '>', Carbon::now())->where('webinar_id','=',$id)->with('course')->paginate(5);
        return view('web.default.panel.assignments.list',compact('assignments'));
    }


    public function myAssignments(){

        $user = new User;
        $assignments =  $user->getUserAssignments();

        return view('web.default.panel.assignments.myassignments',compact('assignments'));



    }

    public function create(){
        return view('web.default.panel.assignments.create');
    }

    public function store(){

    }

    public function download($id){
        $file = Assignment::where('id',$id)->first();
        return response()->download(public_path($file->file));
     }

     public function upload($id){
        $file = Assignment::where('id',$id)->first();
        return view('web.default.panel.assignments.upload',compact('file'));
     }


     public function submit_assignment(Request $request){
         
       $upload = new AssignmentUpload();
       $upload->assignment_id = $request->assignment_id;
       $upload->file = $request->file;
       $upload->user_id = Auth::user()->id;
       if($upload->save()){
           return back()->with('message','Assignment Uploaded');
       }


     }


}
