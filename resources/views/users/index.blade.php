@extends('layouts.app')
@section('title')
    Create users
    @endsection
@section('content')
    <script>
        function getDetail(id) {
            var url = "{{url('users/showUsersModal')}}/" + id;
            var token = "{{ csrf_token() }}";
            $.get(url,function (res1) {
                console.log(res1[0]);
                res= res1[0];
                var name = res.name;
                var profile_firstname = res.profile_firstname;
                var profile_lastname = res.profile_lastname;
                var email = res.email;
                var profile_phonenumber = res.profile_phonenumber;
                var role=res.role;
                var usergroup_name= res.usergroup_name;
                var org_name= res.org_name;
                var profile_paypalclient_id= res.profile_paypalclient_id;
                $('#name').text(name);
                $('#profile_firstname').text(profile_firstname);
                $('#profile_lastname').text(profile_lastname);
                $('#email').text(email);
                $('#profile_phonenumber').text(profile_phonenumber);
                $('#role').text(role);
                $('#usergroup_name').text(usergroup_name);
                $('#org_name').text(org_name);
                $('#profile_paypalclient_id').text(profile_paypalclient_id);
            });
        }
    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{url('users/create')}}"><input type="submit" value="Create Users"> </a>

                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <th>User Name</th>
                            <th>Email Address</th>
                            <th>User Role</th>
                            <th>Action </th>
                            </thead>
                            <tbody>
                            @foreach($users as $var)
                                <tr>
                                    <td><a href ="{{url('users',$var->id)}}">{{$var->name}}</a></td>
                                    <td>{{$var->email}}</td>
                                    <td>{{$var->role}}</td>
                                    <td>
                                        <div class="btn-toolbar">
                                            {{-- Call Edit--}}
                                            <a class="btn btn-warning" href="{{'users/'.$var->id.'/edit'}}">
                                                <span class="glyphicon glyphicon-edit"></span></a>
                                            </a>

                                            {{--<form  method="get" action="{{action('UsersController@edit',$var->id)}}">--}}
                                                {{--<input type="submit" class="btn btn-success" value="EDIT">--}}
                                            {{--</form>--}}

                                            {{--Call show--}}
                                            <a class="btn btn-success"
                                                onclick="getDetail({{$var->id}})"
                                                data-toggle="modal" data-target="#myUsersModal">
                                                <span class="glyphicon glyphicon-eye-open"></span>
                                            </a>

                                            {{-- Call Delete--}}
                                            <form class ="delete" method="post"
                                                  onclick="return confirm('Are you sure you want to disable the user?')"
                                                  action="{{action('UsersController@destroy',$var->id)}}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger btn-del" type="submit" value="disable">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </button>
                                            </form>
                                        </div>

                                     </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myUsersModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">User Details</h4>
                    </div>

                    <div class="modal-body">
                        <table class="table table-bordered table-hover">
                            <tbody>
                            <tr><td>User Name  </td><td> <span id="name"></span></td></tr>
                            <tr><td>First Name </td><td> <span id="profile_firstname"></span></td></tr>
                            <tr><td>Last Name  </td><td> <span id="profile_lastname"></span></td></tr>
                            <tr><td>Email Address </td><td><span id="email"></span></td></tr>
                            <tr><td>Phone Number  </td><td><span id="profile_phonenumber"></span></td></tr>
                            <tr><td>User Role   </td><td><span id="role"></span></td></tr>
                            <tr><td>User Group  </td><td><span id="usergroup_name"></span></td></tr>
                            <tr><td>Organization</td><td><span id="org_name"></span></td></tr>
                            <tr><td>Pay Pal Client Id </td><td><span id="profile_paypalclient_id"></span></td></tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
