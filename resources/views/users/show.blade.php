@extends('layouts.app')
@section('title')
    show User Details
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        User Details
                    </div>
                    <div class="panel-body">

                        <ul>
                            <ul>
                                <li>User Name         : {{$users->name}}</li>
                                <li>First Name        : {{$profile->profile_firstname}}</li>
                                <li>Last Name         : {{$profile->profile_lastname}}</li>
                                <li>Email Address     : {{$users->email}}</li>
                                <li>Phone Number      : {{$profile->profile_phonenumber}}</li>
                                <li>User Role         : {{$users->role}}</li>
                                <li>User Group        : {{$profile->usergroup->usergroup_name}}</li>
                                <li>Organization      : {{$profile->organization->org_name}}</li>
                                <li>Pay Pal Client Id : {{$profile->profile_paypalclient_id}}</li>
                            </ul>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
