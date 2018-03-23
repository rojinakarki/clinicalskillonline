@extends('layouts.app')
@section('title')
    Create UserGroup
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">
                        <form method="post" action="{{url('usergroup')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <label for="usergroup_name">UserGroup Name *</label>
                            <input type ="text" name="usergroup_name" class="form-control" required>
                            <br>
                            <label for="usergroup_tag">UserGroup Tag *</label>
                            <input type ="text" name="usergroup_tag" class="form-control" required>
                            <br>
                            <input type="submit"  class="btn btn-success" value="Create UserGroup" >
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
