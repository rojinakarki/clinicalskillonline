@extends('layouts.app')
@section('title')
    Add User
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{url('users')}}">
                            {{ csrf_field() }}

                            {{--name--}}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Username</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--email--}}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--role--}}
                            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                <label for="role" class="col-md-4 control-label">User Type</label>

                                <div class="col-md-6">

                                    <select id="role" name="role" class="form-control" required>
                                        @if(Auth::user()->role =='superadmin')
                                            <option value="admin">Admin</option>
                                            <option value="manager">Manager</option>
                                        @elseif(Auth::user()->role =='admin')
                                            <option value="manager">Manager</option>
                                            <option value="learner">Learner</option>
                                        @elseif(Auth::user()->role =='manager')
                                            <option value="learner">Learner</option>
                                        @endif


                                    </select>

                                    @if ($errors->has('role'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                     <hr><hr>

                            {{--profile_firstname--}}
                            <div class="form-group{{ $errors->has('profile_firstname') ? ' has-error' : '' }}">
                                <label for="profile_firstname" class="col-md-4 control-label">First Name *</label>
                                <div class="col-md-6">
                                    <input type ="text" name="profile_firstname"  class="form-control" value="{{ old('profile_firstname') }}"required>
                                    @if ($errors->has('profile_firstname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('profile_firstname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--profile_lastname--}}
                            <div class="form-group{{ $errors->has('profile_lastname') ? ' has-error' : '' }} ">
                                <label for="profile_lastname" class="col-md-4 control-label">Last Name *</label>
                                <div class="col-md-6">
                                    <input type ="text" name="profile_lastname" class="form-control" value="{{ old('profile_lastname') }}" required>
                                    @if ($errors->has('profile_lastname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('profile_lastname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--profile_phonenumber--}}
                            <div class="form-group{{ $errors->has('profile_phonenumber') ? ' has-error' : '' }}">
                                <label for="profile_phonenumber" class="col-md-4 control-label">Phone Number *</label>
                                <div class="col-md-6">
                                    <input type ="text" name="profile_phonenumber" class="form-control" value="{{ old('profile_phonenumber') }}" required>
                                    @if ($errors->has('profile_phonenumber'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('profile_phonenumber') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--usergroup_id--}}
                            <div class="form-group{{ $errors->has('usergroup_id') ? ' has-error' : '' }}">
                                <label for="usergroup_id" class="col-md-4 control-label" >Usergroup </label>
                                <div class="col-md-6">
                                    <select id="usergroup_id" name="usergroup_id" class="form-control" onChange="getOrganization();" required>
                                        @foreach ($usergroup as $var)
                                            <option value="{{ $var->usergroup_id }}">{{$var->usergroup_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('usergroup_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('usergroup_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--org_id--}}
                            <div class="form-group{{ $errors->has('org_id') ? ' has-error' : '' }}">
                                <label for="org_id" class="col-md-4 control-label">Organization</label>
                                <div class="col-md-6">
                                    <select id="org_id" name="org_id" class="form-control" required>
                                        @foreach ($org as $var)
                                            <option value="{{ $var->org_id }}">{{$var->org_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('org_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('org_id') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            {{--profile_paypalclient_id--}}
                            <div class="form-group{{ $errors->has('profile_paypalclient_id') ? ' has-error' : '' }}">
                                <label for="profile_paypalclient_id" class="col-md-4 control-label">Paypal Client Id *</label>
                                <div class="col-md-6">
                                    <input type ="text" name="profile_paypalclient_id" class="form-control" value="{{ old('profile_paypalclient_id') }}" required>
                                    @if ($errors->has('profile_paypalclient_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('profile_paypalclient_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--profile_palpalclientsecret--}}
                            <div class="form-group{{ $errors->has('profile_paypalclientsecret') ? ' has-error' : '' }}">
                                <label for="profile_paypalclientsecret" class="col-md-4 control-label">Paypal Client Secret *</label>
                                <div class ="col-md-6">
                                    <input type ="password" name="profile_paypalclientsecret" class="form-control" value="{{ old('profile_paypalclientsecret') }}" required>
                                    @if ($errors->has('profile_paypalclientsecret'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('profile_paypalclientsecret') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--submit button--}}
                            <div class="form-group">
                                <div class="col-md-6">
                                    <input type="submit" class="btn btn-success" value="Add User" >
                                </div>

                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function getOrganization() {
            var id= $('#usergroup_id').val();
            var url = "{{url('users/getUsersList')}}/" + id;
            var token = "{{ csrf_token() }}";
            $.get(url,function (res) {
                $('#org_id').empty();
                $.each(res, function(key, element) {
                    $('#org_id').append("<option value='" + element.org_id +"'>" + element.org_name + "</option>");
                });
            });
        }
    </script>
@endsection
