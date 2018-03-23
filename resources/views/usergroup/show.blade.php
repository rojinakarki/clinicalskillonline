@extends('layouts.app')
@section('title')
   User Group details
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        User Group Details
                    </div>
                    <div class="panel-body">

                        <ul>
                            <li>User Group Name : {{$usergroup->usergroup_name}}</li>
                            <li>User Group Tag: {{$usergroup->usergroup_tag}}</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
