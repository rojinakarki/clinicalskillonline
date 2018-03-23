@extends('layouts.app')
@section('title')
    Edit Organization
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">

                        <form method="post" action="{{route('organization.update',$org->org_id)}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PATCH">
                            <label for="org_name">Organization Name </label>
                            <input type ="text" name="org_name" value="{{$org->org_name}}" class="form-control">
                            <input type="submit" class="btn btn-success" value="Update Organization" >
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
