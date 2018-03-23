@extends('layouts.app')
@section('title')
    Edit User Profile
    @endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        @foreach($profile as $var)
                        <form method="Post" action="{{action('ProfileController',$var->profile_id)}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="form-group">
                                <label for="profile_firstname">First Name</label>
                                <input type ="text" name="profile_firstname" value="{{$var->profile_firstname}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="profile_lastname">Last Name</label>
                                <input type ="text" name="profile_lastname" value="{{$var->profile_lastname}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="profile_phonenumber">Phone Number</label>
                                <input type ="text" name="profile_phonenumber" value="{{$var->profile_phonenumber}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="org_id">Organization</label><br>
                                <input type= "text" value="{{$var->org_name}}"  class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="profile_usergroup">User Group</label><br>
                                <input type= "text" name="profile_usergroup" value="{{$var->profile_usergroup}}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="profile_paypalclient_id">Paypal Client Id</label>
                                <input type ="email" name="profile_paypalclient_id" value="{{$var->profile_paypalclient_id}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="profile_paypalclientsecret">Paypal Client Secret</label>
                                <input type ="password" name="profile_paypalclientsecret" value="{{$var->profile_paypalclientsecret}}" class="form-control">
                            </div>
                            <input type="submit" value="Update Profile" >
                        </form>
                            @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
