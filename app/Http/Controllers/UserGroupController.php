<?php

namespace ClinicalSkillOnline\Http\Controllers;

use ClinicalSkillOnline\Model\Usergroup;
use ClinicalSkillOnline\Http\Requests\StoreUsergroupPostRequest;
use Session;
use DB;
use Illuminate\Http\Request;

class UserGroupController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $usergroup = Usergroup::all();
        $organization = array();
        foreach($usergroup as $key => $data)
        {
            $org = DB::table('organization')
                ->where('usergroup_id', $data->usergroup_id)
                ->get();

            $organization[$key] = $org;
        }
        return view ('usergroup.index',compact('usergroup', 'organization'));

//        Previous Solution :-
//        $usergroup =Usergroup::all();
//        return view ('usergroup.index',compact('usergroup'));

    }

    public function create()
    {
        return view ('usergroup.create');
    }

    public function store(StoreUsergroupPostRequest $request)
    {
        $in = $request->all();
        Usergroup::create($in);
        Session::flash("success","UserGroup was successfully added !");
        return redirect('usergroup');
    }

    public function show(Request $request)
    {
        $id=$request->get('id');
        $usergroup= Usergroup::findorFail($id);
        return $usergroup;
//        Previous solution :-
//        $usergroup= Usergroup::findorFail($id);
//        return view('usergroup.show',compact('usergroup'));

    }

    public function edit($id)
    {
        $usergroup=Usergroup::findOrFail($id);
        return view('usergroup.edit',compact('usergroup'));
    }

    public function update(StoreUsergroupPostRequest $request, $id)
    {
        $in = $request->all();
        $input=Usergroup::findOrFail($id);
        $input->update($in);
        Session::flash("success","UserGroup is updated successfully! ");
        return redirect ('usergroup');
    }

    public function destroy($id)
    {
        $out=Usergroup::findOrFail($id);
        $out->delete();
        return redirect ('usergroup');
    }

    public function showUsergroupModal($id){
        $usergroup =Usergroup::find($id);
        return $usergroup;
    }
}
