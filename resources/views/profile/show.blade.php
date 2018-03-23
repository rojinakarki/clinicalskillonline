@extends('layouts.app')
@section('title')
   User details
    @endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       Profile Details
                    </div>
                    <div class="panel-body">
                        @foreach($profile as $var)
                        <ul>
                            <li>First Name : {{$var->profile_firstname}}</li>
                            <li>Last Name:   {{$var->profile_lastname}}</li>
                            <li>Email Address :  {{$var->email}}</li>
                            <li>Phone Number :  {{$var->profile_phonenumber}}</li>
                            <li>Organization :  {{$var->profile_org_name}}</li>
                            <li>User Group  :  {{$var->profile_usergroup}}</li>
                            <li>Paypal Client Id :{{$var->profile_paypalclient_id}} </li>


                        </ul>
                            @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
