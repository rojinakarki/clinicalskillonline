<?php

namespace ClinicalSkillOnline\Http\Controllers;

use ClinicalSkillOnline\Model\Course;
use ClinicalSkillOnline\Http\Requests\StorePackagePostRequest;
use Illuminate\Http\Request;
use ClinicalSkillOnline\Model\Package;
use Session;
use DB;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $package = Package::all();
        foreach ($package as $key => $var) {
            $course = $var->package_course;
            $course_array = explode(',', $course);
            $course_select = Course::select('course_title')
                ->whereIn('course_id', $course_array)
                ->get();
            $course_title = "<ol>";
            foreach ($course_select as $item) {
                $course_title .= "<li>" . $item->course_title . "</li> ";
            }
            $course_title .= "</ol>";
            $package[$key]->courses_titles = $course_title;

            //removing the right comma
            //=rtrim($course_title,', ');
        }

        return view('package.index', compact('package'));
    }

    public function create()
    {
        $course = Course::all();
        return view('package.create', compact('course'));
    }

    public function store(StorePackagePostRequest $request)
    {
        $course = $request->package_course;
        if (count($course) < 1) {
            return redirect()
                ->back();
        }
        $package = new Package;
        $package->package_name = $request->package_name;
        $package->package_price = $request->package_price;
        $package->package_course = implode(",", $course);
        $package->save();

        Session::flash("success", "Package was successfully added !");
        return redirect('package');
    }

    public function show($id)
    {
        $package = Package::findorFail($id);
        $var = $package->package_course;
        $vars = explode(",", $var);
        //Alternate solution
//        $course=DB::table('course')
//            ->select('course_title')
//            ->wherein('course_id',$vars)
//            ->get();

        $course = Course::select('course_title')
            ->whereIn('course_id', $vars)
            ->get();
        return view('package.show', compact('package', 'course'));
    }

    public function edit($id)
    {
        $package = Package::findOrFail($id);
        $var = $package->package_course;
        $checked_var = explode(",", $var);
        $course = Course::all();
        return view('package.edit', compact('package', 'checked_var', 'course'));
    }

    public function update(StorePackagePostRequest $request, $id)
    {
        $package = Package::find($id);
        $package->package_name = $request->package_name;
        $package->package_price = $request->package_price;
        $course = $request->package_course;
        $package->package_course = implode(",", $course);
        $package->save();

        Session::flash("success", "Package was successfully updated!");
        return redirect('package');
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
        return redirect()->route('package.index');
    }

    public function showPackageModal($id)
    {

        $package = Package::find($id);
        $course = $package->package_course;
        //converting string into array
        $course_array = explode(',', $course);
        //retrieving corresponding name according to id
        $course_select = Course::select('course_title')
                ->whereIn('course_id', $course_array)
                ->get();

            $course_title = "<ul>";
            foreach ($course_select as $item) {
                $course_title .= '<li>'. $item->course_title . "</li>";
            }
            $course_title.='</ul>';
            $package->courses_titles =rtrim($course_title,', ');

        return $package;
    }
}
