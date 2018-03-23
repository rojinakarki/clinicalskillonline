@extends('layouts.app')
@section('title')
    Profile page
    @endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{url('profile/create')}}"><input type="submit" value="Create Profile"> </a>

                    </div>
                    <div class="panel-body">

                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone Number</th>
                                <th>UserGroup</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>
                            @foreach($profile as $var)
                            <tr>
                                <td><a href ="{{url('profile',$var->profile_id)}} ">{{$var->profile_firstname}}</a></td>
                                <td>{{$var->profile_lastname}}</td>
                                <td>{{$var->profile_phonenumber}}</td>
                                <td>{{$var->usergroup->usergroup_name}}</td> {{--use of eloquent model--}}
                                <td><a href="{{route('profile.edit',$var->profile_id)}}"><input type="submit" value="EDIT"></a></td>
                                <td>
                                    <form class ="delete" method="post" action="{{action('ProfileController@destroy',$var->profile_id)}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" onclick="return confirm('Are you sure?')" value="DELETE">
                                    </form>
                                </td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
