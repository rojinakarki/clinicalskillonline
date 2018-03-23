@extends('layouts.app')
@section('title')
    Organization Page
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>List of Organization</strong>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <th>Organization Name</th>
                            <th>Action</th>
                            </thead>
                            <tbody>
                            @foreach($org as $var)
                                <tr>
                                    <td>{{$var->org_name}}</td>
                                    <td>
                                        <form class="edit" method="get" action="{{route('organization.edit',$var->org_id)}}">
                                            <input type="submit" class="btn btn-success" value="Edit">
                                        </form>

                                        <form class="delete" method="post" action="{{route('organization.destroy',$var->org_id)}}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')" value="Delete">
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
