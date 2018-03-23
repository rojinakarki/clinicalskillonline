<?php

namespace ClinicalSkillOnline\Http\Controllers;

use Illuminate\Http\Request;
use ClinicalSkillOnline\Model\Lesson;
use ClinicalSkillOnline\Http\Requests\StoreLessonPostRequest;
use Image;
use Session;
use File;
use Validator;
use Input;

class LessonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $lesson = Lesson::all();


        return view ('lesson.index',compact('lesson'));
    }

    public function create()
    {

    }

    public function createLesson($id)
    {
        $courseId =$id;
        return view ('lesson.create',compact('courseId'));
    }

    public function store(StoreLessonPostRequest $request)
    {
//        $rules = array(
//            'order' => 'required|integer',
//            'lesson_title' => 'required|string|max:255',
//            //Other validation rule is causing a problem
//            'lesson_description' => 'required_without_all:lesson_image,lesson_video',
//            'lesson_image' => 'required_without_all:lesson_description,lesson_video|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//            'lesson_video' => 'required_without_all:lesson_description,lesson_image',
//        );
//        $validator = Validator::make(Input::all(), $rules);
//        if ($validator->fails()) {
//            return redirect()
//                ->back()
//                ->withErrors($validator)
//                ->withInput(); //withInput() not working
//        }

        $lesson = new Lesson();
        $lesson->course_id = $request->course_id;
        $lesson->order = $request->order;
        $lesson->lesson_title = $request->lesson_title;

        if($request->lesson_description){
            $lesson->lesson_description = $request->lesson_description;
        }
        if($request->lesson_video){
            $url=$this->YoutubeID($request->lesson_video);
            $lesson->lesson_video =$url;
        }

        if ($request->hasFile('lesson_image')) {
            $image = $request->file('lesson_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(150, 158)->save($location);
            $lesson->lesson_image = $filename;
        }
        $lesson->save();
        Session::flash("success", "Lesson was successfully added !");
        return redirect('lesson');
    }

    public function show($id)
    {

        //
    }

    public function edit($id)
    {
        $lesson=Lesson::findOrFail($id);
        return view('lesson.edit',compact('lesson'));
    }

    public function update(StoreLessonPostRequest $request, $id)
    {
//        $rules = array(
//            'order' => 'required|integer',
//            'lesson_title' => 'required|string|max:255',
//            //Other validation rule is causing a problem
//            'lesson_description' => 'required_without_all:lesson_image,lesson_video',
//            'lesson_image' => 'required_without_all:lesson_description,lesson_video',
//            'lesson_video' => 'required_without_all:lesson_description,lesson_image',
//        );
//        $validator = Validator::make(Input::all(), $rules);
//        if ($validator->fails()) {
//            return redirect()
//                ->back()
//                ->withErrors($validator)
//                ->withInput(); //withInput() not working
//        }

        $lesson =Lesson::find($id);
        $lesson->order = $request->order;
        $lesson->lesson_title = $request->lesson_title;

        if($request->lesson_description){
            $lesson->lesson_description = $request->lesson_description;
        }
        if($request->lesson_video){

            $lesson->lesson_video = $request->lesson_video;
        }
        if($request->hasFile('lesson_image'))
        {
            $image = $request->file('lesson_image');
            $fileName= time().'.'.$image->getClientOriginalExtension();
            $location =public_path('images/'.$fileName);
            Image::make($image)->resize(150,158)->save($location);

            //grab the old filename
            $oldFilename = $lesson->lesson_image;

            //update the database
            $lesson->lesson_image=$fileName;

            //delete the image
            File::delete(public_path('images/'. $oldFilename));

        }
        $lesson->save();
        Session::flash("success", "Lesson was successfully updated !");
        return redirect('lesson');

    }

    public function destroy($id)
    {
        $lesson=Lesson::findOrFail($id);
        //delete the image from storage
        File::delete(public_path('images/'. $lesson->lesson_image));
        $lesson->delete();
        return redirect ('lesson');
    }

    public function YoutubeID($url)
    {
        if(strlen($url) > 11)
        {
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
            {
                return $match[1];
            }
            else
                return false;
        }

        return $url;
    }

}
