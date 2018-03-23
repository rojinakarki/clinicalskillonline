<?php

namespace ClinicalSkillOnline\Http\Controllers;

use ClinicalSkillOnline\Http\Requests\StoreCoursePostRequest;
use ClinicalSkillOnline\Model\Course;
use Image;
use Session;
use File;
class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $course=Course::all();
        return view('course.index',compact('course'));
    }

    public function create()
    {
        return view ('course.create');
    }

    public function store(StoreCoursePostRequest $request)
    {
        $course = new Course;
        $course->course_title =$request->course_title;
        $course->course_status =$request->course_status;
        $course->course_alttext =$request->course_alttext;
        $course->course_price =$request->course_price;
        $course->course_description =$request->course_description;
        $course->course_democourse= $request->has('course_democourse')? 1 : 0;

        if($request->hasFile('course_coverimage'))
        {
            $image = $request->file('course_coverimage');
            $filename= time().'.'.$image->getClientOriginalExtension();
            $location =public_path('images/'.$filename);
            Image::make($image)->resize(150,158)->save($location);
            $course ->course_coverimage=$filename;
        }
        $course->save();
        Session::flash("success","Course was successfully added !");
        return redirect('course');

    }

    public function show($id)
    {
        $course= Course::findorFail($id);
        return view('course.show',compact('course'));
    }

    public function edit($id)
    {
        $course=Course::findOrFail($id);
        return view('course.edit',compact('course'));
    }

    public function update(StoreCoursePostRequest $request, $id)
    {
        $course =Course::find($id);
        $course->course_status = $request->input('course_status');
        $course->course_title = $request->input('course_title');
        $course->course_price = $request->input('course_price');
        $course->course_description = $request->input('course_description');
        $course->course_alttext = $request->input('course_alttext');
        $course->course_democourse= $request->has('course_democourse')? 1 : 0;

        if($request->hasFile('course_coverimage'))
        {
            $image = $request->file('course_coverimage');
            $fileName= time().'.'.$image->getClientOriginalExtension();
            $location =public_path('images/'.$fileName);
            Image::make($image)->resize(150,158)->save($location);

            //grab the old filename
            $oldFilename = $course->course_coverimage;

            //update the database
            $course->course_coverimage=$fileName;

            //delete the image
            //Storage::delete($oldFilename)); ->didnt work afterwards(worked in L5.4)
            File::delete(public_path('images/'. $oldFilename));

        }

        $course->save();
        Session::flash("success","Course is updated successfully! ");
        return redirect('course');}

    public function destroy($id)
    {
        $course=Course::findOrFail($id);
        //delete the image from storage
        //Storage::delete($oldFilename)); -> didnt work afterwards (worked in L5.4)
        File::delete(public_path('images/'. $course->course_coverimage));
        $course->delete();
        return redirect ('course');
    }

    public function showCourseModal($id)
    {
        $course=Course::find($id);
        return $course;
    }

}
