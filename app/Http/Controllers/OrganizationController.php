<?php

namespace ClinicalSkillOnline\Http\Controllers;

use ClinicalSkillOnline\Model\Organization;
use ClinicalSkillOnline\Model\Usergroup;
use ClinicalSkillOnline\Http\Requests\StoreOrganizationPostRequest;
use Session;

class OrganizationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $org = Organization::all();
        return view('organization.index',compact('org'));
    }

    public function create()
    {

    }

    public function createOrganization($id)
    {
        $usergroup=Usergroup::findOrFail($id);
        $usergroupId =$usergroup->usergroup_id;
        return view ('organization.create',compact('usergroupId'));
    }

    public function store(StoreOrganizationPostRequest $request)
    {
        $org= new Organization();
        $org->usergroup_id=$request->usergroup_id;
        $org->org_name=$request->org_name;
        $org->save();
        Session::flash("success","Organization was successfully added !");
        return redirect('organization');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $org=Organization::findOrFail($id);
        return view('organization.edit',compact('org'));
    }

    public function update(StoreOrganizationPostRequest $request, $id)
    {
        $in = $request->all();
        $Id=$request->org_id;
        $input = Organization::findOrFail($Id);
        $update= $input->update($in);
        if($update){
            Session::flash("success","Organization was successfully updated !");
        }else{
            Session::flash("failure","Organization could not be updated !");
        }
        return redirect('usergroup');
    }

    public function destroy($id,$var)
    {
        $out = Organization::findOrFail($id);
        $out->delete();
        if($var == 0)
            return redirect()->route('organization.index');
        else
            return redirect()->route('usergroup.index');
    }

//    public function destroy($id)
//    {
//        $org = Organization::findOrFail($id);
//        $org->delete();
//        return redirect()->route('organization.index');
//    }

    public function editOrganization($id)
    {
        $org=Organization::find($id);
        return $org;
    }
}
