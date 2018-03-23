@extends('layouts.app')
@section('title')
    Create Organization
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">
                        <form method="post" action="{{url('organization')}}" >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="usergroup_id" value="{{$usergroupId}}">

                            <label for="org_name">Organization Name *</label>
                            <input type ="text" name="org_name" class="form-control" required>
                            <br>

                            <input type="submit"  class="btn btn-success" value="Create Organization" >
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
