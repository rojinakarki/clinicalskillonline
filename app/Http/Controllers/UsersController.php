<?php

namespace ClinicalSkillOnline\Http\Controllers;

use ClinicalSkillOnline\Model\Usergroup;
use ClinicalSkillOnline\Model\Organization;
use ClinicalSkillOnline\Model\Profile;
use ClinicalSkillOnline\User;
use ClinicalSkillOnline\Http\Requests\StoreUsersProfilePostRequest;
use Session;
use DB;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users=User::all();
        return view('users.index',compact('users'));
    }

    public function create()
    {
        $usergroup=Usergroup::all();
        $org=Organization::all();
        return view('users.create',compact('usergroup','org'));
    }

    public function store(StoreUsersProfilePostRequest $request)
    {
        $users = new User();
        $users->name =$request->name;
        $users->email =$request->email;
        $pass = str_random(8);
        $users->password =bcrypt($pass);
        $users->role =$request->role;
        $users->save();
        $inserted_id=$users->id;

        $profile = new Profile();
        $profile->users_id =$inserted_id;
        $profile->profile_firstname =$request->profile_firstname;
        $profile->profile_lastname =$request->profile_lastname;
        $profile->profile_phonenumber =$request->profile_phonenumber;
        $profile->usergroup_id=$request->usergroup_id;
        $profile->org_id =$request->org_id;
        $profile->profile_paypalclient_id =$request->profile_paypalclient_id;
        $profile->profile_paypalclientsecret =$request->profile_paypalclientsecret;
        $profile->save();

        Session::flash("success","Users was successfully added !");
        return redirect('users');

    }

    public function show($id)
    {
        $users= User::findorFail($id);
        $profile = Profile::findorFail($id);
        return view('users.show', compact('users', 'profile'));
    }

    public function edit($id)
    {

        $usergroup = Usergroup::all();
        $org=Organization::all();
        $users = User::findOrFail($id);

        $profile = DB::table('profile')
            ->where('users_id',$id)
            ->first();
        return view('users.edit',compact('usergroup','users','profile','org'));
    }

    public function update(StoreUsersProfilePostRequest $request, $id)
    {

        $users =User::find($id);
        $users->name =$request->name;
        $users->email =$request->email;
        $users->role =$request->role;
        $users->status =$request->status;
        $users->save();

        $profile= array(
            'profile_firstname'=>$request->profile_firstname,
            'profile_lastname' =>$request->profile_lastname,
            'profile_phonenumber' =>$request->profile_phonenumber,
            'usergroup_id'=>$request->usergroup_id,
            'org_id' =>$request->org_id,
            'profile_paypalclient_id' =>$request->profile_paypalclient_id,
            'profile_paypalclientsecret' =>$request->profile_paypalclientsecret
        );
        Profile::where('users_id',$id)->update($profile);

        Session::flash("success","Users was successfully added !");
        return redirect('users');

    }

    public function destroy($id)
    {
        $users=User::findOrFail($id);
        $users->status='0';
        $users->save();
        return redirect ('users');
    }
    public function showUsersModal($id){
        $result=DB::table('profile')
            ->join('users', 'users.id', '=', 'profile.users_id')
            ->join('usergroup', 'usergroup.usergroup_id', '=', 'profile.usergroup_id')
            ->join('organization', 'organization.org_id', '=', 'profile.org_id')
            ->select(['profile.*','users.*','usergroup.usergroup_name','organization.org_name'])
            ->where('profile.profile_id','=',$id)
            ->get();
        return $result;

    }
    public function getUsersList($id)
    {
        $org =Organization::findOrFail($id)
            ->where('usergroup_id',$id)
            ->get();
        return $org;
    }
}
