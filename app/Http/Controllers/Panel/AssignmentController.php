<?php

namespace App\Http\Controllers\panel;

use App\User;
use Carbon\Carbon;
use App\Models\Webinar;
use App\AssignmentUpload;

use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index($id){
        $today=  date('Y-m-d:h-m-s');
        $assignments = Assignment::where('webinar_id','=',$id)->with('course')->paginate(5);


        return view('web.default.panel.assignments.list',compact('assignments'));
    }


    public function myAssignments(){

        $user = new User;
        $assignments =  $user->getUserAssignments();

        return view('web.default.panel.assignments.myassignments',compact('assignments'));



    }

    public function create(){
        $courses =  Webinar::where('status', 'active')
        ->get();

        return view('web.default.panel.assignments.create',compact('courses'));
    }

    public function instructor_assignments($id){
        $assignments = Assignment::where('user_id','=',$id)->with('course')->paginate(5);

        return view('web.default.panel.assignments.list',compact('assignments'));
    }

    public function submited_assignments($id){
        $assignments = AssignmentUpload::where('assignment_id',$id)->with('course')->paginate(5);
        return view('web.default.panel.assignments.submited_assignment',compact('assignments'));
    }

    public function store(Request $request){

        $assignment = new Assignment;
        $validate  = $request->validate([

            'title' => 'required',
            'file' => 'required',
            'course' => 'required'

        ]);


        $assignment->title = $request->title;
        $assignment->file = $request->file;
        $assignment->webinar_id = $request->course;
        $assignment->user_id = Auth::user()->id;
        $assignment->description = $request->description;
        $assignment->deadline = $request->deadline;
        $assignment->save();


        return back()->with('message','Assignment Uploaded');

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
