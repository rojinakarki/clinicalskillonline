<?php

namespace ClinicalSkillOnline\Http\Controllers;


use ClinicalSkillOnline\Model\Profile;
use ClinicalSkillOnline\Model\Usergroup;
use DB;
use Session;
use Illuminate\Http\Request;
class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
//        $profile = DB::table('usergroup')
//            ->join('profile', 'usergroup.usergroup_id', '=', 'profile.usergroup_id')
//            ->select('usergroup.usergroup_name','usergroup.usergroup_id', 'profile.*')
//            ->get();

        $profile = Profile::all();
        return view('profile.index',compact('profile'));
    }

    public function create()
    {
        $usergroup=Usergroup::all();
        return view('profile.create',compact('usergroup'));
    }

    public function store(Request $request)
    {
        $in=Request::capture()->all();
        Profile::create($in);
        Session::flash("success","Profile was successfully added !");
        return redirect('profile');
    }

    public function show($id)
    {
        $profile=DB::table('usergroup')
            ->join('profile', 'usergroup.usergroup_id', '=', 'profile.usergroup_id')
            ->select(['usergroup.usergroup_name','profile.*'])
            ->where('profile.profile_id','=',$id)
            ->get();
        return view('profile.show',compact('profile'));
    }

    public function edit($id)
    {
        $profile=DB::table('usergroup')
            ->join('profile', 'usergroup.usergroup_id', '=', 'profile.usergroup_id')
            ->select(['usergroup.usergroup_name','profile.*'])
            ->where('profile.profile_id','=',$id)
            ->get();
//        print_r($admin);
//        die();
        return view ('profile.edit',compact('profile'));
    }

    public function update(Request $request, $id)
    {
        $in=Request::capture()->all();
        $input=Profile::findOrFail($id);
        $input->update($in);
        Session::flash("success","Profile is updated successfully! ");
        return redirect ('profile');
    }

    public function destroy($id)
    {

        $out=Profile::findOrFail($id);
        $out->delete();
//        Session::flash('deleted_user','The users has been deleted');
        return redirect ('profile');
    }
}
