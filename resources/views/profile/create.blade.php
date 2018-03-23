@extends('layouts.app')
@section('title')
    Create User Profile
    @endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">
                        <form method="post" action="{{url('profile')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <label for="profile_firstname">First Name *</label>
                            <input type ="text" name="profile_firstname"  class="form-control" required>

                            <label for="profile_lastname">Last Name *</label>
                            <input type ="text" name="profile_lastname" class="form-control" required>


                            <label for="profile_phonenumber">Phone Number *</label>
                            <input type ="text" name="profile_phonenumber" class="form-control" required>

                            <label for="usergroup_id">Usergroup </label>
                            <select id="usergroup_id" name="usergroup_id" class="form-control" required>
                                @foreach ($usergroup as $var)
                                    <option value="{{ $var->usergroup_id }}">{{$var->usergroup_name}}</option>
                                @endforeach
                            </select>
                            <label for="profile_organization">Organization</label>
                            <input type ="text" name="profile_organization" class="form-control" >


                            <label for="profile_paypalclient_id">Paypal Client Id *</label>
                            <input type ="text" name="profile_paypalclient_id" class="form-control" required>

                            <label for="profile_paypalclientsecret">Paypal Client Secret *</label>
                            <input type ="password" name="profile_paypalclientsecret" class="form-control" required>
                            <br>
                            <input type="submit" value="Add Profile" >
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
