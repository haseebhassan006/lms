<?php

namespace App\Http\Controllers\admin;

use App\Models\Webinar;
use App\Models\Category;
use App\Models\Assignment;
use App\Models\AssignmentUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with('course')->paginate(10);


        return view('admin.assignments.lists',compact('assignments'));
    }

    public function create()
    {


        $courses =  Webinar::where('status', 'active')
        ->get();


        // $data = [
        //     'assignment' =>$courses ,
        //     'pageTitle' => trans('Assignments'),
        // ];

        return view('admin.assignments.create', compact('courses'));
    }

    public function uploads(){

        $uploads = AssignmentUpload::with(['course','user'])->paginate(5);
        return view('admin.assignments.uploads',compact('uploads'));

    }

    public function store(Request $request)
    {

        $assignment = new Assignment;

        $validate  = $request->validate([

            'title' => 'required',
            'file' => 'required',
            'course' => 'required'

        ]);

        $assignment->title = $request->title;
        $assignment->file = $request->file;
        $assignment->webinar_id = $request->course;
        $assignment->description = $request->description;
        $assignment->deadline = $request->deadline;
        $assignment->save();


        return back()->with('message','Assignment Uploaded');



    }
    public function download($id){


        $file = Assignment::where('id',$id)->first();
        return response()->download(public_path($file->file));
     }

   // public function edit($id)
    // {
    //     $this->authorize('admin_categories_edit');

    //     $category = Category::findOrFail($id);
    //     $subCategories = Category::where('parent_id', $category->id)
    //         ->orderBy('order', 'asc')
    //         ->get();

    //     $data = [
    //         'pageTitle' => trans('admin/pages/categories.edit_page_title'),
    //         'category' => $category,
    //         'subCategories' => $subCategories
    //     ];

    //     return view('admin.categories.create', $data);
    //}

    public function update(Request $request, $id)
    {
        // $this->authorize('admin_categories_edit');

        // $this->validate($request, [
        //     'title' => 'required|min:3|max:128',
        //     'icon' => 'required',
        // ]);

        // $category = Category::findOrFail($id);
        // $category->update([
        //     'title' => $request->input('title'),
        //     'icon' => $request->input('icon'),
        // ]);

        // $hasSubCategories = (!empty($request->get('has_sub')) and $request->get('has_sub') == 'on');
        // $this->setSubCategory($category, $request->get('sub_categories'), $hasSubCategories);


        // cache()->forget(Category::$cacheKey);

        // return redirect('/admin/categories');
    }

    // public function destroy(Request $request, $id)
    // {
    //     $this->authorize('admin_categories_delete');

    //     $category = Category::where('id', $id)->first();

    //     if (!empty($category)) {
    //         Category::where('parent_id', $category->id)
    //             ->delete();

    //         $category->delete();
    //     }

    //     cache()->forget(Category::$cacheKey);

    //     return redirect('/admin/categories');
    // }

    // public function setSubCategory(Category $category, $subCategories, $hasSubCategories)
    // {
    //     $order = 1;
    //     $oldIds = [];

    //     if ($hasSubCategories and !empty($subCategories) and count($subCategories)) {
    //         foreach ($subCategories as $key => $subCategory) {
    //             $check = Category::where('id', $key)->first();

    //             if (is_numeric($key)) {
    //                 $oldIds[] = $key;
    //             }

    //             if (!empty($subCategory['title'])) {
    //                 if (!empty($check)) {
    //                     $check->update([
    //                         'title' => $subCategory['title'],
    //                         'order' => $order,
    //                     ]);
    //                 } else {
    //                     $new = Category::create([
    //                         'title' => $subCategory['title'],
    //                         'parent_id' => $category->id,
    //                         'order' => $order,
    //                     ]);

    //                     $oldIds[] = $new->id;
    //                 }

    //                 $order += 1;
    //             }
    //         }
    //     }

    //     Category::where('parent_id', $category->id)
    //         ->whereNotIn('id', $oldIds)
    //         ->delete();

    //     return true;
    // }
}
