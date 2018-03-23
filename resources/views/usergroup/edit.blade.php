@extends('layouts.app')
@section('title')
    Edit UserGroup
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">

                        <form method="post" action="{{route('usergroup.update',$usergroup->usergroup_id)}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PATCH">
                            <label for="usergroup_name">User Group Name </label>
                            <input type ="text" name="usergroup_name" value="{{$usergroup->usergroup_name}}" class="form-control">
                            <label for="usergroup_tag">user Group Tag</label>
                            <input type ="text" name="usergroup_tag" value="{{$usergroup->usergroup_tag}}" class="form-control">
                            <br>
                            <input type="submit" class="btn btn-success" value="Update User Group" >
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
